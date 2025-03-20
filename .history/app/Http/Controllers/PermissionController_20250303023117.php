<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-permissions')->only('index');
        $this->middleware('permission:create-permissions')->only('store');
        $this->middleware('permission:edit-permissions')->only('update');
        $this->middleware('permission:delete-permissions')->only('destroy');
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
