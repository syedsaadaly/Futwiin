<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PridectionRepository;
use App\Models\Pridection;
use App\Models\UserPredictionLog;
use App\Validators\PridectionValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class PridectionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PridectionRepositoryEloquent extends BaseRepository implements PridectionRepository
{
    protected $planRepo;

    public function __construct(PlanRepository $planRepo) {
        parent::__construct(app());
        $this->planRepo = $planRepo;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pridection::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllPredictions()
    {
        return Pridection::with([
                'team1',
                'team2',
                'predictionDetails.plan'
            ])
            ->orderBy('match_date', 'desc')
            ->orderBy('match_time', 'desc')
            ->get();
    }

    public function getPredictionById($id)
    {
        return Pridection::with([
                'team1',
                'team2',
                'predictionDetails.plan'
            ])
            ->where('id', $id)
            ->firstOrFail();
    }

    public function createPredictionWithDetails(array $predictionData, array $planDeductions, $imageFile = null) {
        $prediction = Pridection::create($predictionData);

        $this->createPredictionDetails($prediction, $planDeductions);

        if ($imageFile) {
            $this->addPredictionImage($prediction, $imageFile);
        }

        return $prediction;
    }

    protected function createPredictionDetails(Pridection $prediction, array $planDeductions): void
    {
        foreach ($planDeductions as $planId => $deduction) {
            $prediction->predictionDetails()->create([
                'plan_id' => $planId,
                'points_deduction' => $deduction
            ]);
        }
    }

    protected function addPredictionImage(Pridection $prediction, $imageFile): void
    {
        $prediction->addMedia($imageFile)
            ->toMediaCollection('prediction_images');
    }

    public function updatePrediction($id, array $data)
    {
        $prediction = $this->getPredictionById($id);
        $prediction->update($data);
        return $prediction;
    }

    public function deletePrediction($id)
    {
        $prediction = $this->getPredictionById($id);
        return $prediction->delete();
    }

    public function checkPredictionAccess($prediction)
    {
        $user = auth()->user();
        $timezone = config('app.timezone', 'Asia/Karachi');

        if (!$user->plan_id) {
            return [
                'success' => false,
                'message' => 'You need to subscribe to a plan first'
            ];
        }

        $plan = $this->planRepo->find($user->plan_id);
        $predictionDetail = $this->getPredictionDetail($prediction, $plan->id);

        if (!$predictionDetail) {
            return [
                'success' => false,
                'message' => 'This prediction is not available for your plan'
            ];
        }

        $accessCheck = $this->checkAccessTime($prediction, $plan, $timezone);
        if (!$accessCheck['success']) {
            return $accessCheck;
        }

        if ($user->wallet < $predictionDetail->points_deduction) {
            return [
                'success' => false,
                'message' => 'Insufficient points in your wallet'
            ];
        }

        $this->processPredictionAccess($user, $prediction, $predictionDetail, $plan);

        return ['success' => true];
    }

    protected function getPredictionDetail($prediction, $planUuid)
    {
        return $prediction->details()
            ->where('plan_id', $planUuid)
            ->first();
    }

    protected function checkAccessTime($prediction, $plan, $timezone)
    {
        $matchTime = Carbon::create(
            $prediction->match_date->year,
            $prediction->match_date->month,
            $prediction->match_date->day,
            Carbon::parse($prediction->match_time)->hour,
            Carbon::parse($prediction->match_time)->minute,
            0,
            $timezone
        );

        $currentTime = Carbon::now($timezone);
        $earliestAccessTime = $matchTime->copy()->subMinutes($plan->predicted_view_duration_offset);

        if ($currentTime->lt($earliestAccessTime)) {
            $minutesLeft = $currentTime->diffInMinutes($earliestAccessTime);
            $timeLeft = $this->formatTimeLeft($minutesLeft);

            return [
                'success' => false,
                'message' => "You can access this prediction $timeLeft before match ({$plan->predicted_view_duration_offset} minutes early access)"
            ];
        }

        return ['success' => true];
    }

    protected function formatTimeLeft($minutes)
    {
        if ($minutes >= 60) {
            $hours = floor($minutes / 60);
            $remainingMinutes = $minutes % 60;
            $timeLeft = $hours . ' hour' . ($hours > 1 ? 's' : '');
            if ($remainingMinutes > 0) {
                $timeLeft .= ' and ' . $remainingMinutes . ' minute' . ($remainingMinutes > 1 ? 's' : '');
            }
            return $timeLeft;
        }

        return $minutes . ' minute' . ($minutes > 1 ? 's' : '');
    }

    protected function processPredictionAccess($user, $prediction, $predictionDetail, $plan)
    {
        DB::transaction(function () use ($user, $prediction, $predictionDetail, $plan) {
            $oldWallet = $user->wallet;
            $user->wallet -= $predictionDetail->points_deduction;
            $user->save();

            UserPredictionLog::create([
                'pred_id' => $prediction->id,
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'old_wallet' => $oldWallet,
                'new_wallet' => $user->wallet,
                'points_deduction' => $predictionDetail->points_deduction
            ]);

            $expiresAt = Carbon::now(config('app.timezone'))
                ->addMinutes($plan->predicted_view_duration_offset);
            session()->put('prediction_access.'.$prediction->id, $expiresAt);
        });
    }

    public function getUpcomingPredictions(bool $teaserOnly = false)
    {
        $query = Pridection::with(['team1', 'team2', 'league'])
            ->where('match_date', '>=', Carbon::now()->toDateString())
            ->orderBy('match_date')
            ->orderBy('match_time');

        if ($teaserOnly) {
            $query->where('is_teaser', true);
        }

        return $query->get();
    }

    public function hasTeaserPredictions(): bool
    {
        return Pridection::where('is_teaser', true)->exists();
    }
}
