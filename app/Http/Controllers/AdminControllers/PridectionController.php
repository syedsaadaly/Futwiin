<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePredictionRequest;
use App\Http\Requests\UpdatePredictionRequest;
use App\Models\Plan;
use App\Models\Pridection;
use App\Models\Team;
use App\Models\UserPredictionLog;
use App\Repositories\LeagueRepository;
use App\Repositories\PlanRepository;
use App\Repositories\PridectionRepository;
use App\Repositories\TeamRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PridectionController extends Controller
{
    protected $predictionRepo;
    protected $teamRepo;
    protected $planRepo;
    protected $leagueRepo;

    public function __construct(
        PridectionRepository $predictionRepo,
        TeamRepository $teamRepo,
        PlanRepository $planRepo,
        LeagueRepository $leagueRepo,
    ) {
        $this->predictionRepo = $predictionRepo;
        $this->teamRepo = $teamRepo;
        $this->planRepo = $planRepo;
        $this->leagueRepo = $leagueRepo;
    }

    public function index()
    {
        $pageData = (object) [
            'pageTabTitle'    => 'Predictions',
            'pageName'        => 'All Predictions',
            'showTableInfo'   => true,
        ];

        $predictions = $this->predictionRepo->getAllPredictions();

        return view('admin.predictions.index', compact('predictions', 'pageData'));
    }

    public function create()
    {
        $pageData = (object) [
            'pageTabTitle'  => 'Predictions',
            'pageName'      => 'Create Predictions',
            'showTableInfo' => true,
        ];

        $teams = $this->teamRepo->getAllTeams();
        $plans = $this->planRepo->getAllPlans();
        $leagues = $this->leagueRepo->getAllLeagues();

        return view('admin.predictions.create', compact('teams', 'pageData', 'plans','leagues'));
    }

    public function store(StorePredictionRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $prediction = $this->predictionRepo->createPredictionWithDetails(
                $validatedData,
                $request->input('plan_deductions', []),
                $request->file('image')
            );

            DB::commit();

            return redirect()
                ->route('admin.predictions.index')
                ->with('success', 'Prediction created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Error creating prediction: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pageData = (object) [
            'pageTabTitle'  => 'Predictions',
            'pageName'      => 'Edit Predictions',
            'showTableInfo' => true,
        ];

        try {
            $prediction = $this->predictionRepo->getPredictionById($id);
            $teams = $this->teamRepo->getAllTeams();
            $plans = $this->planRepo->getAllPlans();
            $leagues = $this->leagueRepo->getAllLeagues();

            return view('admin.predictions.edit', compact(
                'prediction',
                'teams',
                'pageData',
                'plans',
                'leagues'
            ));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('admin.predictions.index')
                ->with('error', 'Prediction not found');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.predictions.index')
                ->with('error', 'Failed to load prediction data. Please try again.');
        }
    }

    public function update(UpdatePredictionRequest $request, $id)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $prediction = $this->predictionRepo->updatePrediction($id, $data);

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
            $this->predictionRepo->deletePrediction($id);
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
        try {
            $result = $this->predictionRepo->checkPredictionAccess($prediction);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'],
                    'redirect' => !auth()->user()->plan_id ? route('front.pricing') : null
                ]);
            }

            $html = view('front.partial.modal_content', [
                'prediction' => $prediction,
                'details' => $this->predictionRepo->getPredictionDetail($prediction, auth()->user()->plan_id)
            ])->render();

            return response()->json([
                'success' => true,
                'html' => $html
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
