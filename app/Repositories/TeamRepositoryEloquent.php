<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeamRepository;
use App\Models\Team;
use App\Validators\TeamValidator;

/**
 * Class TeamRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TeamRepositoryEloquent extends BaseRepository implements TeamRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Team::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllTeams()
    {
        return Team::orderBy('created_at', 'desc')->get();
    }

    public function getTeamById($id)
    {
        return Team::where('id', $id)->firstOrFail();
    }

    public function createTeam(array $data)
    {
        return Team::create($data);
    }

    public function updateTeam($id, array $data)
    {
        return $this->update($data, $id);
    }

    public function deleteTeam($id)
    {
        $team = $this->getTeamById($id);
        return $team->delete();
    }
}
