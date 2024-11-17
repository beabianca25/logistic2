<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Use 'admin.auth.register' if you have a specific view for admin registration
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'], // Ensure 'admins' is your table name
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => strtolower($request->email), // Convert email to lowercase before storing
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($admin));

        // Redirect to the login page with a success message
        return redirect()->route('admin.login')->with('status', 'Registration successful! Please log in to continue.');
    }
}

