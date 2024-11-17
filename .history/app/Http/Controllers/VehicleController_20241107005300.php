<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    // Display a listing of the vehicles.
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('fleet.vehicle.index', compact('vehicles'));
    }

    // Show the form for creating a new vehicle.
    public function create()
    {
        return view('fleet.vehicle.create');
    }

    // Store a newly created vehicle in the database.
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'license_plate' => 'required|string|unique:vehicles',
            'vin' => 'required|string|unique:vehicles',
            'capacity' => 'required|integer',
            'current_status' => 'required|in:active,inactive,maintenance,retired',
            'insurance_info' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        } else {
            $imagePath = null;
        }

        // Create the vehicle record
        Vehicle::create([
            'vehicle_type' => $request->vehicle_type,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'vin' => $request->vin,
            'capacity' => $request->capacity,
            'current_status' => $request->current_status,
            'insurance_info' => $request->insurance_info,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully.');
    }

    // Display the specified vehicle.
    public function show($id)
    {
        $vehicle = Vehicle::with(['drivers', 'trips', 'maintenances', 'fuels'])
                          ->findOrFail($id);
    
        return view('vehicle.show', compact('vehicle'));
    }
    

    // Show the form for editing the specified vehicle.
    public function edit(Vehicle $vehicle)
    {
        return view('fleet.vehicle.edit', compact('vehicle'));
    }

    // Update the specified vehicle in the database.
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'vin' => 'required|string|unique:vehicles,vin,' . $vehicle->id,
            'capacity' => 'required|integer',
            'current_status' => 'required|in:active,inactive,maintenance,retired',
            'insurance_info' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($vehicle->image_path && Storage::exists('public/' . $vehicle->image_path)) {
                Storage::delete('public/' . $vehicle->image_path);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        } else {
            $imagePath = $vehicle->image_path; // Keep the old image if no new image was uploaded
        }

        // Update the vehicle record
        $vehicle->update([
            'vehicle_type' => $request->vehicle_type,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'vin' => $request->vin,
            'capacity' => $request->capacity,
            'current_status' => $request->current_status,
            'insurance_info' => $request->insurance_info,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    // Remove the specified vehicle from the database.
    public function destroy(Vehicle $vehicle)
    {
        // Delete the image file if it exists
        if ($vehicle->image_path && Storage::exists('public/' . $vehicle->image_path)) {
            Storage::delete('public/' . $vehicle->image_path);
        }

        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
    }
}
