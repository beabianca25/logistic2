<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::with(['vehicle', 'approvedBy'])->get(); // Eager load vehicle & approver
        $vehicles = Vehicle::all();
        $users = User::all(); // Fetch users for approval selection

        return view('Fleet.Maintenance.index', compact('maintenances', 'vehicles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $users = User::all();

        return view('Fleet.Maintenance.create', compact('vehicles', 'users'));
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
            'service_vendor_contact' => 'nullable|string|max:255',
            'labor_cost' => 'nullable|numeric',
            'parts_cost' => 'nullable|numeric',
            'total_cost' => 'nullable|numeric',
            'parts_replaced' => 'nullable|string',
            'odometer_reading' => 'nullable|integer',
            'warranty_period' => 'nullable|string|max:255',
            'next_service_due' => 'nullable|date',
            'issue_reported' => 'nullable|string',
            'issue_fixed' => 'nullable|string',
            'technician_name' => 'nullable|string|max:255',
            'maintenance_notes' => 'nullable|string',
            'maintenance_status' => 'required|in:Pending,In Progress,Completed,Cancelled',
            'approved_by' => 'nullable|exists:users,id',
        ]);

        Maintenance::create($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('Fleet.Maintenance.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        $vehicles = Vehicle::all();
        $users = User::all();

        return view('Fleet.Maintenance.edit', compact('maintenance', 'vehicles', 'users'));
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
            'service_vendor_contact' => 'nullable|string|max:255',
            'labor_cost' => 'nullable|numeric',
            'parts_cost' => 'nullable|numeric',
            'total_cost' => 'nullable|numeric',
            'parts_replaced' => 'nullable|string',
            'odometer_reading' => 'nullable|integer',
            'warranty_period' => 'nullable|string|max:255',
            'next_service_due' => 'nullable|date',
            'issue_reported' => 'nullable|string',
            'issue_fixed' => 'nullable|string',
            'technician_name' => 'nullable|string|max:255',
            'maintenance_notes' => 'nullable|string',
            'maintenance_status' => 'required|in:Pending,In Progress,Completed,Cancelled',
            'approved_by' => 'nullable|exists:users,id',
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
