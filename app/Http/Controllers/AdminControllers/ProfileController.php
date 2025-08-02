<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $pageData = (object)[
            'pageTabTitle' => 'Profile Settings',
            'pageName' => 'Update Profile',
            'showTableInfo'=> false,
        ];

        return view('admin.profile.index', compact('pageData'));
    }

    public function update(Request $request)
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
