<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'current_password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];

        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($data['current_password'], $user->password)) {
                return back()->with('error', 'Current password is incorrect');
            }
            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
