<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function dashboard()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Dashboard',
            'pageName' => 'Dashboard',
            'showTableInfo'=> true,
        ];
        return view('user.dashboard.dashboard-2',compact('pageData'));
    }

    public function profileEditPage()
    {
         $pageData = (object)[
            'pageTabTitle' => 'Profile Settings',
            'pageName' => 'Update Profile',
            'showTableInfo'=> false,
        ];

        return view('user.profile.index', compact('pageData'));
    }

    public function profileUpdate(UpdateProfileRequest $request)
    {
        try {
            $this->userRepo->updateProfile($request->validated());
            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating profile: '.$e->getMessage());
        }
    }
}
