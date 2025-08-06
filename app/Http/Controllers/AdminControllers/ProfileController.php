<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Profile Settings',
            'pageName' => 'Update Profile',
            'showTableInfo'=> false,
        ];

        return view('admin.profile.index', compact('pageData'));
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $this->userRepo->updateProfile($request->validated());
            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating profile: '.$e->getMessage());
        }
    }
}
