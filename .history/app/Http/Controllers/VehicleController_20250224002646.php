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
            'gps_tracking_id' => 'nullable|string',
            'last_maintenance_date' => 'nullable|date',
            'next_maintenance_due' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric',
            'depreciation_value' => 'nullable|numeric',
            'registration_expiry_date' => 'nullable|date',
            'owner_name' => 'nullable|string',
            'leasing_details' => 'nullable|string',
            'current_status' => 'required|in:Active,Inactive,Maintenance,Retired',
            'insurance_info' => 'nullable|string',
            'remarks' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle image upload
        $imagePath = $request->hasFile('image') ? 
            $request->file('image')->store('vehicle_images', 'public') : null;
    
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
            'gps_tracking_id' => $request->gps_tracking_id,
            'last_maintenance_date' => $request->last_maintenance_date,
            'next_maintenance_due' => $request->next_maintenance_due,
            'purchase_date' => $request->purchase_date,
            'purchase_price' => $request->purchase_price,
            'depreciation_value' => $request->depreciation_value,
            'registration_expiry_date' => $request->registration_expiry_date,
            'owner_name' => $request->owner_name,
            'leasing_details' => $request->leasing_details,
            'current_status' => $request->current_status,
            'insurance_info' => $request->insurance_info,
            'remarks' => $request->remarks,
            'image_path' => $imagePath,
        ]);
    
        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully.');
    }
    

    // Display the specified vehicle.
    public function show($id)
    {
        $vehicle = Vehicle::with(['drivers', 'trips', 'maintenances', 'fuels'])
                          ->findOrFail($id);
    
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

        return redirect()->route('Vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    // Remove the specified vehicle from the database.
    public function destroy(Vehicle $vehicle)
    {
        // Delete the image file if it exists
        if ($vehicle->image_path && Storage::exists('public/' . $vehicle->image_path)) {
            Storage::delete('public/' . $vehicle->image_path);
        }

        $vehicle->delete();

        return redirect()->route('Vehicle.index')->with('success', 'Vehicle deleted successfully.');
    }
}
