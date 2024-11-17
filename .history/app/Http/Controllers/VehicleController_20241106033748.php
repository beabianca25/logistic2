<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('fleet.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        return view('fleet.vehicle.create');
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|between:1900,' . date('Y'),
            'vin' => 'required|string|max:17|unique:vehicles',
            'registration_number' => 'required|string|unique:vehicles',
            'capacity' => 'required|integer',
            'current_status' => 'required|in:active,inactive,maintenance,retired',
            'insurance_info' => 'nullable|string',
            'image_path' => 'nullable|string',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicle.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified vehicle.
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('fleet.vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('fleet.vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'make' => 'sometimes|required|string|max:255',
            'model' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer|between:1900,' . date('Y'),
            'vin' => 'sometimes|required|string|max:17|unique:vehicles,vin,' . $id,
            'registration_number' => 'sometimes|required|string|unique:vehicles,registration_number,' . $id,
            'capacity' => 'sometimes|required|integer',
            'current_status' => 'sometimes|required|in:active,inactive,maintenance,retired',
            'insurance_info' => 'nullable|string',
            'image_path' => 'nullable|string',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
    }
}
