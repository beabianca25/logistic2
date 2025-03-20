<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User; // Import the User model
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Get all users except Super Admin (-1 role)
        $users = User::where('role', '!=', -1)->get();
        return view('superadmin', compact('users')); // Ensure the view exists
    }

    public function updatePermissions(Request $request, User $user)
    {
        // Validate input
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'boolean', // Each permission value must be boolean
        ]);

        foreach ($request->permissions as $module => $can_access) {
            Permission::updateOrCreate(
                ['user_id' => $user->id, 'module' => $module],
                ['can_access' => (bool) $can_access] // Ensure it’s stored as a boolean
            );
        }

        return back()->with('success', 'Permissions updated successfully!');
    }
}
