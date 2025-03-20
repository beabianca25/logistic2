<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view permission', ['only' => ['index']]);
    //     $this->middleware('permission:create permission', ['only' => ['create','store']]);
    //     $this->middleware('permission:update permission', ['only' => ['update','edit']]);
    //     $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    // }


    public function index()
    {
        $permissions = Permission::get();
        return view('RolePermission.Permission.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('RolePermission.Permission.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Created Successfully');

    }


    public function show()
    {
        return view();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

        return view('RolePermission.Permission.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        // $request->validate([
        //     'name' => [
        //         'required',
        //         'string',
        //         'unique:permissions,name,'.$permission->id
        //     ]
        // ]);

        // $permission->update([
        //     'name' => $request->name
        // ]);

        // return redirect('permissions')->with('status','Permission Updated Successfully');
    }


    public function destroy()
    {

    }
}
