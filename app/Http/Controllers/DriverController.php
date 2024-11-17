<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle; // Include the Vehicle model
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
{
    $drivers = Driver::all();
    $vehicles = Vehicle::all(); // Load vehicles for the dropdown
    return view('fleet.driver.index', compact('drivers', 'vehicles'));
}


    public function create()
    {
        $vehicles = Vehicle::all(); // Retrieve all vehicles
        return view('fleet.driver.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'driver_name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:drivers',
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'license_expiry_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        Driver::create($request->all());

        return redirect()->route('driver.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver)
    {
        return view('fleet.driver.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $vehicles = Vehicle::all(); // Retrieve all vehicles for selection
        return view('fleet.driver.edit', compact('driver', 'vehicles'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'driver_name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:drivers,license_number,' . $driver->id,
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'license_expiry_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        $driver->update($request->all());

        return redirect()->route('driver.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('driver.index')->with('success', 'Driver deleted successfully.');
    }
}
