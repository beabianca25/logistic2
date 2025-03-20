<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRelease;
use App\Models\VehicleReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('Fleet.Vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        return view('Fleet.Vehicle.create');
    }

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
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->hasFile('image_path') 
            ? $request->file('image_path')->store('vehicle_images', 'public')
            : null;

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

    public function show(Vehicle $vehicle)
    {
        return view('Fleet.Vehicle.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('Fleet.Vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
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
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->hasFile('image_path') 
            ? $request->file('image_path')->store('vehicle_images', 'public')
            : null;

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

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->image_path) {
            Storage::delete('public/' . $vehicle->image_path);
        }

        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function publicIndex()
    {
        $vehicles = Vehicle::where('current_status', 'Active')->get();
        return view('PublicShow.publicvehicle', compact('vehicles'));
    }

    public function getActiveVehicleCount()
    {
        $activeVehicleCount = Vehicle::where('current_status', 'Active')->count();
        return response()->json(['activeVehicleCount' => $activeVehicleCount]);
    }
}
