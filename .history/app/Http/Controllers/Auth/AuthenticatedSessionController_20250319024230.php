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
    $request->authenticate();
    $request->session()->regenerate();

    $authUserRole = Auth::user()->role;

    if ($authUserRole === 'superadmin') {  
        return redirect()->intended(route('dashboard', absolute: false));
    } elseif ($authUserRole === 'admin') {  
        return redirect()->intended(route('dashboard', absolute: false));
    } elseif ($authUserRole === 'vendor') {  
        return redirect()->intended(route('vendor', absolute: false));
    } elseif ($authUserRole === 'customer') {  
        return redirect()->intended(route('userdashboard', absolute: false));
    } else {  
        return redirect()->route('login')->with('error', 'Unauthorized role.');
    }
}

    /**
     * Log the user out and redirect to the login page.
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
