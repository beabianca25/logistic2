<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . date('Y'),
        'vin' => 'required|string|max:17',
        'registration_number' => 'required|string|max:15',
        // Add other validation rules as necessary
    ]);

    $vehicle = new Vehicle();
    $vehicle->model = $request->model;
    $vehicle->year = $request->year;
    $vehicle->vin = $request->vin;
    $vehicle->registration_number = $request->registration_number;
    $vehicle->current_status = $request->current_status;
    // Add other attributes as necessary
    $vehicle->save();

    return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
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
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'model' => 'required|string',
            'year' => 'required|integer',
            'vin' => 'required|string|unique:vehicles,vin,' . $id,
            'registration_number' => 'required|string|unique:vehicles,registration_number,' . $id,
            'current_status' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'license_expiry_date' => 'nullable|date',
            'status' => 'required|string',
            'maintenance_schedule' => 'nullable|string|max:255',
            'fuel_refill_date' => 'nullable|date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($vehicle->image_path) {
                Storage::disk('public')->delete($vehicle->image_path);
            }
            $vehicle->image_path = $request->file('image')->store('vehicles', 'public');
        }

        // Update vehicle record
        $vehicle->update($request->except(['image']));

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        // Delete the image if it exists
        if ($vehicle->image_path) {
            Storage::disk('public')->delete($vehicle->image_path);
        }

        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
    }
}
