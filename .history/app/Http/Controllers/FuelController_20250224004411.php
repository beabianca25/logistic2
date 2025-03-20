<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuels = Fuel::with(['vehicle', 'approvedBy'])->get(); // Eager load vehicle & approver
        $vehicles = Vehicle::all();
        $users = User::all(); // Fetch users for approval selection

        return view('Fleet.Fuel.index', compact('fuels', 'vehicles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $users = User::all();

        return view('Fleet.Fuel.create', compact('vehicles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'refill_date' => 'required|date',
            'fuel_amount' => 'required|numeric',
            'cost' => 'required|numeric',
            'total_cost' => 'nullable|numeric',
            'fuel_station' => 'required|string|max:255',
            'fuel_station_location' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|in:Petrol,Diesel,Electric,Hybrid',
            'odometer_reading' => 'nullable|integer',
            'fuel_efficiency' => 'nullable|numeric',
            'payment_method' => 'nullable|in:Cash,Credit Card,Fuel Card,Company Account',
            'receipt_number' => 'nullable|string|max:255',
            'vendor_contact' => 'nullable|string|max:255',
            'fuel_status' => 'required|in:Pending,Approved,Rejected,Completed',
            'approved_by' => 'nullable|exists:users,id',
        ]);

        Fuel::create($request->all());

        return redirect()->route('fuel.index')->with('success', 'Fuel refill record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fuel $fuel)
    {
        return view('Fleet.Fuel.show', compact('fuel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fuel $fuel)
    {
        $vehicles = Vehicle::all();
        $users = User::all();

        return view('Fleet.Fuel.edit', compact('fuel', 'vehicles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fuel $fuel)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'refill_date' => 'required|date',
            'fuel_amount' => 'required|numeric',
            'cost' => 'required|numeric',
            'total_cost' => 'nullable|numeric',
            'fuel_station' => 'required|string|max:255',
            'fuel_station_location' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|in:Petrol,Diesel,Electric,Hybrid',
            'odometer_reading' => 'nullable|integer',
            'fuel_efficiency' => 'nullable|numeric',
            'payment_method' => 'nullable|in:Cash,Credit Card,Fuel Card,Company Account',
            'receipt_number' => 'nullable|string|max:255',
            'vendor_contact' => 'nullable|string|max:255',
            'fuel_status' => 'required|in:Pending,Approved,Rejected,Completed',
            'approved_by' => 'nullable|exists:users,id',
        ]);

        $fuel->update($request->all());

        return redirect()->route('fuel.index')->with('success', 'Fuel refill record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuel $fuel)
    {
        $fuel->delete();
        return redirect()->route('fuel.index')->with('success', 'Fuel refill record deleted successfully.');
    }
}
