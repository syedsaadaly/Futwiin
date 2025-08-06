<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LeagueRepository;
use App\Models\League;
use App\Validators\LeagueValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class LeagueRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeagueRepositoryEloquent extends BaseRepository implements LeagueRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return League::class;
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function indexPage()
    {
        $pageData = (object)[
            'pageTabTitle' => 'League',
            'pageName' => 'All League',
            'showTableInfo'=> true,
        ];

        $leagues = League::all();

        return (object) ['leagues' => $leagues, 'pageData' => $pageData];

    }

    public function leagueStore(array $validatedData, $imageFile = null)
    {
        try {
            $league = League::create([
                'title' => $validatedData['title'],
                'type' => $validatedData['type'],
                'league_date' => Carbon::parse($validatedData['league_date']),
                'text' => $validatedData['text'] ?? null,
            ]);

            if ($imageFile) {
                $league->addMedia($imageFile)
                    ->toMediaCollection('league_images');
            }

            return $league;

        } catch (\Exception $e) {
            \Log::error('League store error: ' . $e->getMessage());
            return $e;
        }
    }

    public function findLeagueById($id)
    {
        return League::findOrFail($id);
    }

    public function updateLeague(array $validatedData, $id, $imageFile = null)
    {
        try {
            $league = League::findOrFail($id);

            $league->update([
                'title' => $validatedData['title'],
                'type' => $validatedData['type'],
                'league_date' => Carbon::parse($validatedData['league_date']),
                'text' => $validatedData['text'] ?? null,
            ]);

            if ($imageFile) {
                $league->clearMediaCollection('league_images');
                $league->addMedia($imageFile)
                    ->toMediaCollection('league_images');
            }

            return $league;

        } catch (\Exception $e) {
            Log::error('League update error: ' . $e->getMessage());
            return $e;
        }
    }

    public function deleteLeague($id)
    {
        $leagueId = $id;
        $league = League::findOrFail($leagueId);

        try {
            $league->clearMediaCollection('league_images');
            $league->delete();

            return true;
        } catch (\Exception $e) {
            \Log::error('League delete error: ' . $e->getMessage());
            throw $e;
        }
    }
    
    public function getDomesticLeagues()
    {
        return League::where('type', 2)
            ->orderBy('title')
            ->get();
    }

    public function getInternationalLeagues()
    {
        return League::where('type', 1)
            ->orderBy('title')
            ->get();
    }
}
