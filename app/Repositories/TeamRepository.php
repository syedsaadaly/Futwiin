<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TeamRepository.
 *
 * @package namespace App\Repositories;
 */
interface TeamRepository extends RepositoryInterface
{
    public function getAllTeams();
    public function getTeamById($id);
    public function deleteTeam($id);
    public function createTeam(array $data);
    public function updateTeam($id, array $data);
}
