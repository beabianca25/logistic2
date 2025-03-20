<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    // Display a listing of the vehicles.
    public function index()
    {
        $vehicles = Vehicle::select('id', 'vehicle_type', 'model', 'manufacturer', 'year_of_manufacture', 'license_plate','capacity', 'current_status', 'image_path')->get();
        return view('Fleet.Vehicle.index', compact('vehicles'));
    }

    // Show the form for creating a new vehicle.
    public function create()
    {
        return view('Fleet.Vehicle.create');
    }

    // Store a newly created vehicle in the database.
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'manufacturer' => 'required|string',
            'year_of_manufacture' => 'required|integer',
            'license_plate' => 'required|string|unique:vehicles',
            'vin' => 'required|string|unique:vehicles',
            'capacity' => 'required|integer',
            'fuel_type' => 'required|in:Petrol,Diesel,Electric,Hybrid',
            'mileage' => 'nullable|integer',
            'color' => 'nullable|string',
            'engine_number' => 'required|string|unique:vehicles',
            'chassis_number' => 'required|string|unique:vehicles',
            'current_status' => 'required|in:Active,Inactive,Maintenance,Retired',
            'remarks' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->hasFile('image') ? 
            $request->file('image')->store('vehicle_images', 'public') : null;

        // Log uploaded image path and status for debugging
        Log::info('Vehicle Image Path:', ['image_path' => $imagePath]);
        Log::info('Vehicle Status:', ['current_status' => $request->current_status]);

        // Create vehicle record
        Vehicle::create([
            'vehicle_type' => $request->vehicle_type,
            'model' => $request->model,
            'manufacturer' => $request->manufacturer,
            'year_of_manufacture' => $request->year_of_manufacture,
            'license_plate' => $request->license_plate,
            'vin' => $request->vin,
            'capacity' => $request->capacity,
            'fuel_type' => $request->fuel_type,
            'mileage' => $request->mileage,
            'color' => $request->color,
            'engine_number' => $request->engine_number,
            'chassis_number' => $request->chassis_number,
            'current_status' => $request->current_status,
            'remarks' => $request->remarks,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully.');
    }

    // Display the specified vehicle.
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('Fleet.Vehicle.show', compact('vehicle'));
    }

    // Show the form for editing the specified vehicle.
    public function edit(Vehicle $vehicle)
    {
        return view('Fleet.Vehicle.edit', compact('vehicle'));
    }

    // Update the specified vehicle in the database.
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'manufacturer' => 'required|string',
            'year_of_manufacture' => 'required|integer',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'vin' => 'required|string|unique:vehicles,vin,' . $vehicle->id,
            'capacity' => 'required|integer',
            'fuel_type' => 'required|in:Petrol,Diesel,Electric,Hybrid',
            'mileage' => 'nullable|integer',
            'color' => 'nullable|string',
            'engine_number' => 'required|string|unique:vehicles,engine_number,' . $vehicle->id,
            'chassis_number' => 'required|string|unique:vehicles,chassis_number,' . $vehicle->id,
            'current_status' => 'required|in:Active,Inactive,Maintenance,Retired',
            'remarks' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($vehicle->image_path && Storage::exists('public/' . $vehicle->image_path)) {
                Storage::delete('public/' . $vehicle->image_path);
            }
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        } else {
            $imagePath = $vehicle->image_path;
        }

        // Log updated image path and status for debugging
        Log::info('Updated Vehicle Image Path:', ['image_path' => $imagePath]);
        Log::info('Updated Vehicle Status:', ['current_status' => $request->current_status]);

        // Update the vehicle
        $vehicle->update([
            'vehicle_type' => $request->vehicle_type,
            'model' => $request->model,
            'manufacturer' => $request->manufacturer,
            'year_of_manufacture' => $request->year_of_manufacture,
            'license_plate' => $request->license_plate,
            'vin' => $request->vin,
            'capacity' => $request->capacity,
            'fuel_type' => $request->fuel_type,
            'mileage' => $request->mileage,
            'color' => $request->color,
            'engine_number' => $request->engine_number,
            'chassis_number' => $request->chassis_number,
            'current_status' => $request->current_status,
            'remarks' => $request->remarks,
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
