<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('fleet.vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        return view('fleet.vehicle.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'license_plate' => 'required|integer',
            'vin' => 'required|string|unique:vehicles',
            'registration_number' => 'required|string|unique:vehicles',
            'capacity' => 'required|integer',
            'current_status' => 'required|in:active,inactive,maintenance,retired',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('fleet.vehicle.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('fleet.vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'license_plate' => 'required|integer' . $vehicle->id,,
            'vin' => 'required|string|unique:vehicles,vin,' . $vehicle->id,
            'capacity' => 'required|integer',
            'current_status' => 'required|in:active,inactive,maintenance,retired',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
    }
}
