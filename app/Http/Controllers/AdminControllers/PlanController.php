<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
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
        $pageData = (object) [
            'pageTabTitle' => 'Plans',
            'pageName' => 'All Plan',
            'showTableInfo'=> true,
        ];

        $plans = $this->planRepo->getAllPlans();

        return view('admin.plan.index', compact('plans', 'pageData'));
    }

    public function create()
    {
        $pageData = (object) [
            'pageTabTitle' => 'Create Plans',
            'pageName' => 'Create Plan',
            'showTableInfo'=> true,
        ];

        return view('admin.plan.create', compact('pageData'));
    }

    public function store(StorePlanRequest $request)
    {
        try {
            $this->planRepo->createPlan($request->validated());

            return redirect()
                ->route('admin.plans.index')
                ->with('success', 'Plan created successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error creating plan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pageData = (object) [
            'pageTabTitle' => 'Edit Plans',
            'pageName' => 'Edit Plan',
            'showTableInfo' => true,
        ];

        try {
            $plan = $this->planRepo->getPlanById($id);
            return view('admin.plan.edit', compact('plan', 'pageData'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('admin.plans.index')
                ->with('error', 'Plan not found');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.plans.index')
                ->with('error', 'Failed to load plan. Please try again.');
        }
    }

    public function update(UpdatePlanRequest $request, $id)
    {
        try {
            $this->planRepo->updatePlan($id, $request->validated());

            return redirect()
                ->route('admin.plans.index')
                ->with('success', 'Plan updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating plan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->planRepo->deletePlan($id);

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
