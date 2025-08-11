<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Plan;
use App\Models\Pridection;
use App\Models\Team;
use App\Models\User;
use App\Models\UserPlan;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $adminRepo;

    public function __construct(UserRepositoryEloquent $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function dashboard(Request $request)
    {
        $stats = $this->adminRepo->getStats();
        $recentUsers = $this->adminRepo->getRecentUsers(5);
        $recentPlans = $this->adminRepo->getRecentPlans(5);
        $recentPredictions = $this->adminRepo->getRecentPredictions(5);
        $recentLeagues = $this->adminRepo->getRecentLeagues(5);
        $recentTeams = $this->adminRepo->getRecentTeams(5);
        $recentUserPlans = $this->adminRepo->getRecentUserPlans(5);

        $pageData = (object)[
            'pageTabTitle' => 'Admin Dashboard',
            'pageName' => 'Dashboard Overview',
            'showTableInfo' => false,
        ];

        return view('admin.dashboard.dashboard-2', [
            'pageData' => $pageData,
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'recentPlans' => $recentPlans,
            'recentPredictions' => $recentPredictions,
            'recentLeagues' => $recentLeagues,
            'recentTeams' => $recentTeams,
            'recentUserPlans' => $recentUserPlans,
        ]);
    }

    public function users(Request $request)
    {
        $pageData = (object)[
            'pageTabTitle' => 'User',
            'pageName' => 'All Users',
            'showTableInfo'=> true,
        ];

        $users = $this->adminRepo->getAllUsers();

        return view('admin.user.index', compact('pageData', 'users'));
    }

    public function deleteUser(Request $request, $id)
    {
       try {
            $this->adminRepo->deleteUserById($id);

            return response()->json(['status' => 'success', 'message' => 'User has been deleted successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
