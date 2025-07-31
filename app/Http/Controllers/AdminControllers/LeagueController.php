<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Repositories\LeagueRepository;
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
       return $this->leagueRepo->indexPage();
    }
    public function create()
    {
       return $this->leagueRepo->createPage();
    }
    public function store(Request $request)
    {
        try {
            $this->leagueRepo->leagueStore($request);
            return redirect()->route('admin.leagues.index')
                ->with('success', 'League created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'League creation failed: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
       return $this->leagueRepo->editPage($id);
    }
    public function update(Request $request,$id)
    {
        try {
            $this->leagueRepo->updateLeague($request , $id);
            return redirect()->route('admin.leagues.index')
                ->with('success', 'League Update successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'League Update failed: ' . $e->getMessage());
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
