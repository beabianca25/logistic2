<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

        return view('RolePermission.Permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      

        return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

       
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
       
        return view('Fleet.Fuel.edit', compact('fuel', 'vehicles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        

        return redirect()->route('fuel.index')->with('success', 'Fuel refill record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
       
    }
}
