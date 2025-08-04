<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePredictionRequest;
use App\Http\Requests\UpdatePredictionRequest;
use App\Models\Plan;
use App\Models\Pridection;
use App\Models\Team;
use App\Models\UserPredictionLog;
use App\Repositories\PridectionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PridectionController extends Controller
{
    protected $predictionRepo;

    public function __construct(PridectionRepository $predictionRepo)
    {
        $this->predictionRepo = $predictionRepo;
    }

    public function index()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Predictions',
            'pageName' => 'All Predictions',
            'showTableInfo'=> true,
        ];
        $predictions = $this->predictionRepo->getAllPredictions();
        return view('admin.predictions.index', compact('predictions','pageData'));
    }

    public function create()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Predictions',
            'pageName' => 'Create Predictions',
            'showTableInfo'=> true,
        ];
        $teams = Team::all();
        $plans = Plan::all();
        return view('admin.predictions.create', compact('teams','pageData','plans'));
    }

    public function store(StorePredictionRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $prediction = $this->predictionRepo->createPrediction($data);

            foreach ($request->input('plan_deductions') as $planId => $deduction) {
                $prediction->predictionDetails()->create([
                    'plan_id' => $planId,
                    'points_deduction' => $deduction
                ]);
            }

            if ($request->hasFile('image')) {
                $prediction->addMediaFromRequest('image')
                    ->toMediaCollection('prediction_images');
            }

            DB::commit();

            return redirect()->route('admin.predictions.index')
                ->with('success', 'Prediction created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error creating prediction: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $pageData = (object)[
            'pageTabTitle' => 'Predictions',
            'pageName' => 'Edit Predictions',
            'showTableInfo'=> true,
        ];
        $prediction = $this->predictionRepo->getPredictionById(decrypt($id));
        $teams = Team::all();
        $plans = Plan::all();
        return view('admin.predictions.edit', compact('prediction', 'teams','pageData','plans'));
    }

    public function update(UpdatePredictionRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $prediction = $this->predictionRepo->updatePrediction(decrypt($id), $data);

            $prediction->predictionDetails()->delete();
            foreach ($request->input('plan_deductions') as $planId => $deduction) {
                $prediction->predictionDetails()->create([
                    'plan_id' => $planId,
                    'points_deduction' => $deduction
                ]);
            }

            if ($request->hasFile('image')) {
                $prediction->clearMediaCollection('prediction_images');
                $prediction->addMediaFromRequest('image')
                    ->toMediaCollection('prediction_images');
            }

            DB::commit();

            return redirect()->route('admin.predictions.index')
                ->with('success', 'Prediction updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error updating prediction: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->predictionRepo->deletePrediction(decrypt($id));
            return response()->json([
                'status' => 'success',
                'message' => 'Prediction deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete prediction: ' . $e->getMessage()
            ], 500);
        }
    }
    public function checkAccess(Pridection $prediction)
    {
        date_default_timezone_set('Asia/Karachi');

        $user = auth()->user();

        if (!$user->plan_id) {
            return redirect()->route('front.pricing')->with('error', 'You need to subscribe to a plan first');
        }

        $plan = Plan::find($user->plan_id);

        $predictionDetail = $prediction->details()->where('plan_id', $plan->uuid)->first();

        if (!$predictionDetail) {
            return back()->with('error', 'This prediction is not available for your plan');
        }

        $matchTime = Carbon::create(
            $prediction->match_date->year,
            $prediction->match_date->month,
            $prediction->match_date->day,
            Carbon::parse($prediction->match_time)->hour,
            Carbon::parse($prediction->match_time)->minute,
            0,
            'Asia/Karachi'
        );

        $currentTime = Carbon::now('Asia/Karachi');
        $earliestAccessTime = $matchTime->copy()->subMinutes($plan->predicted_view_duration_offset);

        if ($currentTime->lt($earliestAccessTime)) {
            $minutesLeft = $currentTime->diffInMinutes($earliestAccessTime);

            if ($minutesLeft >= 60) {
                $hours = floor($minutesLeft / 60);
                $remainingMinutes = $minutesLeft % 60;
                $timeLeft = $hours . ' hour' . ($hours > 1 ? 's' : '');
                if ($remainingMinutes > 0) {
                    $timeLeft .= ' and ' . $remainingMinutes . ' minute' . ($remainingMinutes > 1 ? 's' : '');
                }
            } else {
                $timeLeft = $minutesLeft . ' minute' . ($minutesLeft > 1 ? 's' : '');
            }

            return back()->with('error', "You can access this prediction $timeLeft before match (".$plan->predicted_view_duration_offset." minutes early access)");
        }

        if ($user->wallet < $predictionDetail->points_deduction) {
            return redirect()->back()->with('error', 'Insufficient points in your wallet');
        }

        DB::transaction(function () use ($user, $prediction, $predictionDetail, $plan) {
            $oldWallet = $user->wallet;
            $user->wallet -= $predictionDetail->points_deduction;
            $user->save();

            UserPredictionLog::create([
                'pred_id' => $prediction->uuid,
                'user_id' => $user->id,
                'plan_id' => $plan->uuid,
                'old_wallet' => $oldWallet,
                'new_wallet' => $user->wallet,
                'points_deduction' => $predictionDetail->points_deduction
            ]);
        });

        $expiresAt = Carbon::now('Asia/Karachi')->addMinutes($plan->predicted_view_duration_offset);
        session()->put('prediction_access.'.$prediction->uuid, $expiresAt);

        return redirect()->back()->with('success', 'Prediction accessed successfully!');
    }
}
