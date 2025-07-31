<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PridectionRepository;
use App\Models\Pridection;
use App\Validators\PridectionValidator;

/**
 * Class PridectionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PridectionRepositoryEloquent extends BaseRepository implements PridectionRepository
{
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
        return Pridection::with(['team1', 'team2', 'predictionDetails.plan'])
            ->orderBy('match_date', 'desc')
            ->orderBy('match_time', 'desc')
            ->get();
    }


    public function getPredictionById($id)
    {
        return Pridection::with(['team1', 'team2', 'predictionDetails.plan'])
            ->where('uuid', $id)
            ->firstOrFail();
    }
    public function createPrediction(array $data)
    {
        return Pridection::create($data);
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

}
