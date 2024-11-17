<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show Admin Login Form
    public function showAdminLoginForm()
    {
        return view('admin.admin-login');
    }

    // Show User Login Form
    public function showUserLoginForm()
    {
        return view('user.user-login');
    }

    // Admin Login Logic
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['usertype' => 'admin']))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid admin credentials.');
    }

    // User Login Logic
    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['usertype' => 'user']))) {
            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Invalid user credentials.');
    }
}
