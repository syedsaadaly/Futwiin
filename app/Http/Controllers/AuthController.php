<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Repositories\UserRepository;


class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been successfully logged out.');
    }
    public function showLoginForm()
    {
        return $this->userRepo->showLoginForm();
    }

    public function showRegistrationForm()
    {
        return $this->userRepo->showRegistrationForm();
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->userRepo->login($credentials);

        if (!$user) {
            return redirect()->back()->with(['message' => 'Invalid credentials'], 401);
        }
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }elseif ($user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }else{
            return redirect()->route('front.index');
        }
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6|confirmed',
        ]);

        $user = $this->userRepo->register($validated);
        $user->assignRole('user');
        auth()->login($user);

        if ($request->has('plan')) {
            return redirect()->route('payment.show', $request->plan);
        }

        return redirect()->route('front.pricing')->with(['message' => 'Registration successful', 'user' => $user]);
    }
}
