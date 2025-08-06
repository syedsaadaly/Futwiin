<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PlanRepository.
 *
 * @package namespace App\Repositories;
 */
interface PlanRepository extends RepositoryInterface
{
    public function createPlan(array $data);
    public function updatePlan($id,array $data);
    public function deletePlan($id);
    public function getPlanById($id);
    public function getAllPlans();
    public function getAllOrderedByPrice();
}
