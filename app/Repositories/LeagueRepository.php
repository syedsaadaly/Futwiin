<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LeagueRepository.
 *
 * @package namespace App\Repositories;
 */
interface LeagueRepository extends RepositoryInterface
{
    public function indexPage();
    public function leagueStore(array $validatedData, $imageFile = null);
    public function findLeagueById($id);
    public function updateLeague(array $validatedData, $id, $imageFile = null);
    public function deleteLeague($id);
    public function getAllLeagues();
    public function getDomesticLeagues();
    public function getInternationalLeagues();
}
