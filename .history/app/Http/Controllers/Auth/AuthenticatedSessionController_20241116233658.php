<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Check the user type and redirect accordingly
        $user = Auth::user(); // Get the currently authenticated user

        // if ($user->usertype === 'admin') {
        //     // Redirect to admin dashboard
        //     return redirect()->route('admin.dashboard');
        // }

        // Redirect to user dashboard if the user is not an admin
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        // Redirect to the login page after logout
        return redirect()->route('login')->with('status', 'You have been logged out.');
    }
    
}
