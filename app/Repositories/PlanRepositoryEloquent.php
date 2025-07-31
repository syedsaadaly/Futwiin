<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PlanRepository;
use App\Models\Plan;
use App\Validators\PlanValidator;

/**
 * Class PlanRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlanRepositoryEloquent extends BaseRepository implements PlanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Plan::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function getAllPlans()
    {
        return Plan::orderBy('created_at', 'desc')->get();
    }

    public function getPlanById($id)
    {
        return Plan::where('uuid', $id)->firstOrFail();
    }

    public function createPlan(array $data)
    {
        return Plan::create($data);
    }

    public function updatePlan($id, array $data)
    {
        $plan = $this->getPlanById($id);
        $plan->update($data);
        return $plan;
    }

    public function deletePlan($id)
    {
        $plan = $this->getPlanById($id);
        return $plan->delete();
    }

}
