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
    public function createPage();
    public function leagueStore($request);
    public function editPage($id);
    public function updateLeague($request , $id);
    public function deleteLeague($id);
}
