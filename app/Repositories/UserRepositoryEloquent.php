<?php

namespace App\Repositories;

use App\Models\League;
use App\Models\Plan;
use App\Models\Pridection;
use App\Models\Team;
use App\Models\User;
use App\Models\UserPlan;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\UserRepo;
use App\Validators\UserRepoValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $data['wallet'] = 0.00;

        return $this->create($data);
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        return Auth::user();
    }

     public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been successfully logged out.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function getStats(): array
    {
        return [
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
    }

    public function getRecentUsers(int $limit)
    {
        return User::latest()->take($limit)->get();
    }

    public function getRecentPlans(int $limit)
    {
        return Plan::latest()->take($limit)->get();
    }

    public function getRecentPredictions(int $limit)
    {
        return Pridection::with(['team1', 'team2'])->latest()->take($limit)->get();
    }

    public function getRecentLeagues(int $limit)
    {
        return League::latest()->take($limit)->get();
    }

    public function getRecentTeams(int $limit)
    {
        return Team::latest()->take($limit)->get();
    }

    public function getRecentUserPlans(int $limit)
    {
        return UserPlan::with(['user', 'plan'])->latest()->take($limit)->get();
    }

    public function getAllUsers()
    {
        return User::getAllWithRoles();
    }

    public function deleteUserById($id)
    {
        $user = User::findOrFail($id);

        return $user->delete();
    }

    public function updateProfile(array $data)
    {
        $user = auth()->user();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];

        if (!empty($data['new_password'])) {
            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        return $user;
    }
}
