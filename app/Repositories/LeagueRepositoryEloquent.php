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
        return view('admin.league.index',compact('leagues','pageData'));
    }
    public function createPage()
    {
        $pageData = (object)[
            'pageTabTitle' => 'League',
            'pageName' => 'All League',
            'showTableInfo'=> true,
        ];

        return view('admin.league.create',compact('pageData'));
    }
    public function leagueStore($request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:1,2',
            'league_date' => 'required|date',
            'image' => 'nullable|image',
            'text' => 'nullable|string',
        ])->validate();

        DB::beginTransaction();

        try {
            $league = League::create([
                'title' => $validated['title'],
                'type' => $validated['type'],
                'league_date' => Carbon::parse($validated['league_date']),
                'text' => $validated['text'] ?? null,
            ]);

            if ($request->hasFile('image')) {
                $league->addMediaFromRequest('image')
                    ->toMediaCollection('league_images');
            }

            DB::commit();
            return $league;

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('League store error: ' . $e->getMessage());
            throw $e;
        }
    }
    public function editPage($id)
    {
        $pageData = (object)[
            'pageTabTitle' => 'League',
            'pageName' => 'All League',
            'showTableInfo'=> true,
        ];
        $decryptId = encrypt_decrypt('decrypt',$id);
        $league = League::where('id',$decryptId)->first();
        return view('admin.league.edit',compact('league','pageData'));
    }
    public function updateLeague($request, $id)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:1,2',
            'league_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'text' => 'nullable|string',
        ])->validate();

        $decryptId = encrypt_decrypt('decrypt', $id);
        $league = League::findOrFail($decryptId);

        \DB::beginTransaction();
        try {
            $league->update([
                'title' => $validated['title'],
                'type' => $validated['type'],
                'league_date' => \Carbon\Carbon::parse($validated['league_date']),
                'text' => $validated['text'] ?? null,
            ]);

            if ($request->hasFile('image')) {
                $league->clearMediaCollection('league_images');

                $league->addMediaFromRequest('image')
                    ->toMediaCollection('league_images');
            }

            \DB::commit();
            return $league;

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('League update error: ' . $e->getMessage());
            throw $e;
        }
    }
    public function deleteLeague($id)
    {
        $decryptId = encrypt_decrypt('decrypt',$id);
        $league = League::findOrFail($decryptId);
        try {
            $league->clearMediaCollection('league_images');
            $league->delete();

            return true;

        } catch (\Exception $e) {
            \Log::error('League delete error: ' . $e->getMessage());
            throw $e;
        }
    }
}
