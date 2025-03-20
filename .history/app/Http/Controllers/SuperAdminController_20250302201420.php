<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use User;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', -1)->get(); // Exclude Super Admin
        return view('superadmin', compact('users'));
    }

    public function updatePermissions(Request $request, User $user)
    {
        foreach ($request->permissions as $module => $can_access) {
            Permission::updateOrCreate(
                ['user_id' => $user->id, 'module' => $module],
                ['can_access' => $can_access]
            );
        }

        return back()->with('success', 'Permissions updated successfully!');
    }
}
