<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::with('vehicle')->get();  // Eager load the associated vehicle

    // Fetch all the vehicles for the dropdown or other purposes
    $vehicles = Vehicle::all();

    // Pass both variables to the view
    return view('fleet.maintenance.index', compact('maintenances', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();  // Get all vehicles for the dropdown
        return view('fleet.maintenance.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'maintenance_type' => 'required|string|max:255',
            'maintenance_date' => 'required|date',
            'service_vendor' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'status' => 'required|string|in:pending,completed',
        ]);

        Maintenance::create($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('fleet.maintenance.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        $vehicles = Vehicle::all();
        return view('fleet.maintenance.edit', compact('maintenance', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'maintenance_type' => 'required|string|max:255',
            'maintenance_date' => 'required|date',
            'service_vendor' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'status' => 'required|string|in:pending,completed',
        ]);

        $maintenance->update($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenance.index')->with('success', 'Maintenance record deleted successfully.');
    }
}
