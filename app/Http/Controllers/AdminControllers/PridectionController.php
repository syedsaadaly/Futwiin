<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Team;
use App\Repositories\PridectionRepository;
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

    public function store(Request $request)
    {
        $request->merge(['is_teaser' => $request->has('is_teaser')]);

        $data = $request->validate([
            'team_1_id' => 'required|exists:teams,uuid',
            'team_2_id' => 'required|exists:teams,uuid|different:team_1_id',
            'title' => 'required|string|max:255',
            'match_date' => 'required|date',
            'match_time' => 'required',
            'text' => 'nullable|string',
            'is_teaser' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'plan_deductions' => 'required|array',
            'plan_deductions.*' => 'integer|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Create prediction
            $prediction = $this->predictionRepo->createPrediction($data);

            // Save plan deductions
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

    public function update(Request $request, $id)
    {
        $request->merge(['is_teaser' => $request->has('is_teaser')]);

        $data = $request->validate([
            'team_1_id' => 'required|exists:teams,uuid',
            'team_2_id' => 'required|exists:teams,uuid|different:team_1_id',
            'title' => 'required|string|max:255',
            'match_date' => 'required|date',
            'match_time' => 'required',
            'text' => 'nullable|string',
            'is_teaser' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'plan_deductions' => 'required|array',
            'plan_deductions.*' => 'integer|min:0'
        ]);

        try {
            DB::beginTransaction();

            $prediction = $this->predictionRepo->updatePrediction(decrypt($id), $data);

            // Update plan deductions
            $prediction->predictionDetails()->delete(); // Remove existing
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
}
