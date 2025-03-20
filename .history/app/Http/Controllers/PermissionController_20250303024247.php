<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {

        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'view-permission']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'edit-permission']);
        Permission::create(['name' => 'delete-permission']);
        
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('RolePermission.Permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('RolePermission.Permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name'
        ]);

        Permission::create(['name' => $request->name]);

        return redirect('permission')->with('status', 'Permission Created Successfully');
    }

    public function show(Permission $permission)
    {
        return view('RolePermission.Permission.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('RolePermission.Permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id
        ]);

        $permission->update(['name' => $request->name]);

        return redirect('permission')->with('status', 'Permission Updated Successfully');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect('permission')->with('status', 'Permission Deleted Successfully');
    }
}
