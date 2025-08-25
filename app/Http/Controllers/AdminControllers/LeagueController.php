<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeagueStoreRequest;
use App\Http\Requests\UpdateLeagueRequest;
use App\Repositories\LeagueRepository;
use Exception;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    protected $leagueRepo;

    public function __construct(LeagueRepository $leagueRepo)
    {
       $this->leagueRepo = $leagueRepo;
    }

    public function index()
    {
       try {
        $data = $this->leagueRepo->indexPage();

        $pageData = $data->pageData;
        $leagues = $data->leagues;
        return view('admin.league.index', compact('pageData', 'leagues'));
       } catch(Exception $e) {
            return back()->withInput()
                ->with('error', 'League creation failed: ' . $e->getMessage());
       }
    }

    public function create()
    {
       $pageData = (object)[
            'pageTabTitle' => 'League',
            'pageName' => 'All League',
            'showTableInfo'=> true,
        ];

        return view('admin.league.create',compact('pageData'));
    }

    public function store(LeagueStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $imageFile = $request->file('image');

            $this->leagueRepo->leagueStore($validatedData, $imageFile);

            return redirect()->route('admin.leagues.index')
                ->with('success', 'League created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'League creation failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $leagueId = $id;
            $league = $this->leagueRepo->findLeagueById($leagueId);

            $pageData = (object)[
                'pageTabTitle' => 'League',
                'pageName' => 'All League',
                'showTableInfo' => true,
            ];
            return view('admin.league.edit', compact('league', 'pageData'));

        } catch (\Exception $e) {
            return back()->with('error', 'League not found: ' . $e->getMessage());
        }
    }

    public function update(UpdateLeagueRequest $request, $id)
    {
        try {
            $leagueId = $id;
            $imageFile = $request->file('image');

            $this->leagueRepo->updateLeague($request->validated(), $leagueId, $imageFile);

            return redirect()->route('admin.leagues.index')
                ->with('success', 'League updated successfully!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'League update failed: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->leagueRepo->deleteLeague($id);

            return response()->json([
                'status' => 'success',
                'message' => 'League deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete League: ' . $e->getMessage()
            ], 500);
        }
    }
}
