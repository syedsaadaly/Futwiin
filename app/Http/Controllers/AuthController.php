<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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

    public function login(LoginRequest $request)
    {
        $user = $this->userRepo->login($request->validated());

        if (!$user) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Invalid credentials']);
        }

        return match(true) {
            $user->hasRole('admin') => redirect()->route('admin.dashboard'),
            $user->hasRole('user') => redirect()->route('user.dashboard'),
            default => redirect()->route('front.index')
        };
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userRepo->register($request->validated());
        $user->assignRole('user');
        auth()->login($user);

        if ($request->filled('plan')) {
            return redirect()->route('payment.show', $request->plan);
        }

        return redirect()
        ->route('front.pricing')
        ->with([
            'message' => 'Registration successful',
            'user' => $user
        ]);
    }
}
