<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Plan;
use App\Models\Pridection;
use App\Models\Team;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        $stats = [
            'users' => User::count(),
            'active_users' => User::whereNull('deleted_at')->count(),
            'plans' => Plan::count(),
            'active_plans' => Plan::whereNull('deleted_at')->count(),
            'predictions' => Pridection::count(),
            'upcoming_predictions' => Pridection::where('match_date', '>=', now())->count(),
            'leagues' => League::count(),
            'active_leagues' => League::where('league_date', '>=', now())->count(),
            'teams' => Team::count(),
            'active_user_plans' => UserPlan::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentPlans = Plan::latest()->take(5)->get();
        $recentPredictions = Pridection::with(['team1', 'team2'])
            ->latest()
            ->take(5)
            ->get();
        $recentLeagues = League::latest()->take(5)->get();
        $recentTeams = Team::latest()->take(5)->get();
        $recentUserPlans = UserPlan::with(['user', 'plan'])
            ->latest()
            ->take(5)
            ->get();

        $pageData = (object)[
            'pageTabTitle' => 'Admin Dashboard',
            'pageName' => 'Dashboard Overview',
            'showTableInfo' => false,
        ];

        return view('admin.dashboard.dashboard-2', compact(
            'pageData',
            'stats',
            'recentUsers',
            'recentPlans',
            'recentPredictions',
            'recentLeagues',
            'recentTeams',
            'recentUserPlans'
        ));
    }
    public function users(Request $request)
    {
        $pageData = (object)[
            'pageTabTitle' => 'User',
            'pageName' => 'All Users',
            'showTableInfo'=> true,
        ];

        $users = User::with('roles')->orderBy('created_at', 'desc')->get();

        return view('admin.user.index', compact('pageData', 'users'));
    }

    public function deleteUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail(encrypt_decrypt('decrypt', $id));

            $user->forceDelete();

            return response()->json(['status' => 'success', 'message' => 'User and associated orders has been deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
