<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Repositories\PlanRepository;
use Illuminate\Http\Request;

class PlanController extends Controller
{
      protected $planRepo;

    public function __construct(PlanRepository $planRepo)
    {
        $this->planRepo = $planRepo;
    }

    public function index()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Plans',
            'pageName' => 'All Plan',
            'showTableInfo'=> true,
        ];
        $plans = $this->planRepo->getAllPlans();
        return view('admin.plan.index', compact('plans','pageData'));
    }

    public function create()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Create Plans',
            'pageName' => 'Create Plan',
            'showTableInfo'=> true,
        ];
        return view('admin.plan.create',compact('pageData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'points' => 'required|integer|min:0',
            'predicted_view_duration_offset' => 'required|integer|min:1|max:10080',
        ]);

        try {
            $this->planRepo->createPlan($data);
            return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating plan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pageData = (object)[
            'pageTabTitle' => 'Edit Plans',
            'pageName' => 'Edit Plan',
            'showTableInfo'=> true,
        ];
        $plan = $this->planRepo->getPlanById(decrypt($id));
        return view('admin.plan.edit', compact('plan','pageData'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'points' => 'required|integer|min:0',
            'predicted_view_duration_offset' => 'required|integer|min:1|max:10080',
        ]);

        try {
            $this->planRepo->updatePlan(decrypt($id), $data);
            return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating plan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->planRepo->deletePlan(decrypt($id));
            return response()->json([
                'status' => 'success',
                'message' => 'Plan deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete Plan: ' . $e->getMessage()
            ], 500);
        }
    }
}
