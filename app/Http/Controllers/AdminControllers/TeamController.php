<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;

class TeamController extends Controller
{
     protected $teamRepo;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepo = $teamRepo;
    }

    public function index()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Teams',
            'pageName' => 'All Teams',
            'showTableInfo'=> true,
        ];
        $teams = $this->teamRepo->getAllTeams();
        return view('admin.teams.index', compact('teams','pageData'));
    }

    public function create()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Team',
            'pageName' => 'Create Team',
            'showTableInfo'=> true,
        ];
        return view('admin.teams.create',compact('pageData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name'
        ]);

        try {
            $this->teamRepo->createTeam($data);
            return redirect()->route('admin.teams.index')->with('success', 'Team created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating team: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pageData = (object)[
            'pageTabTitle' => 'Team',
            'pageName' => 'Edit Team',
            'showTableInfo'=> true,
        ];
        $team = $this->teamRepo->getTeamById(decrypt($id));
        return view('admin.teams.edit', compact('team','pageData'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,'.decrypt($id).',uuid'
        ]);

        try {
            $this->teamRepo->updateTeam(decrypt($id), $data);
            return redirect()->route('admin.teams.index')->with('success', 'Team updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating team: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->teamRepo->deleteTeam(decrypt($id));
            return response()->json([
                'status' => 'success',
                'message' => 'Team deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete team: ' . $e->getMessage()
            ], 500);
        }
    }
}
