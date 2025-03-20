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
      

        return view('Fleet.Fuel.create', compact('vehicles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

        return redirect()->route('fuel.index')->with('success', 'Fuel refill record created successfully.');
    }

   
    public function show(Fuel $fuel)
    {
        return view('Fleet.Fuel.show', compact('fuel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fuel $fuel)
    {
       
        return view('Fleet.Fuel.edit', compact('fuel', 'vehicles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fuel $fuel)
    {
        

        return redirect()->route('fuel.index')->with('success', 'Fuel refill record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuel $fuel)
    {
       
        return redirect()->route('fuel.index')->with('success', 'Fuel refill record deleted successfully.');
    }
}
