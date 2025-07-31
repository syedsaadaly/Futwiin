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
    public function createPrediction(array $data);
    public function updatePrediction($id, array $data);
    public function deletePrediction($id);
}
