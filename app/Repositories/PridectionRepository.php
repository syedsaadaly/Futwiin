<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PridectionRepository.
 *
 * @package namespace App\Repositories;
 */
interface PridectionRepository extends RepositoryInterface
{
    public function getAllPredictions();
    public function getPredictionById($id);
    public function createPredictionWithDetails(array $predictionData, array $planDeductions, $imageFile = null);
    public function updatePrediction($id, array $data);
    public function deletePrediction($id);
    public function checkPredictionAccess($prediction);
    public function getUpcomingPredictions(bool $teaserOnly = false);
    public function hasTeaserPredictions(): bool;
}
