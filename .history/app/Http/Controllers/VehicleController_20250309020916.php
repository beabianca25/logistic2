<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRelease;
use App\Models\VehicleReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('vehicle_images', 'public') : null;

        Vehicle::create(array_merge($request->except('image'), ['image_path' => $imagePath]));

        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('Fleet.Vehicle.show', compact('vehicle'));
    }

    public function edit($id)
    {
        $release = VehicleRelease::findOrFail($id);
        $vehicles = VehicleReservation::where('status', 'Approved')->get(); // Fetch vehicles
        $vehicles = Vehicle::all(); // Fetch all vehicles
    
        return view('Reservation.Release.edit', compact('release', 'vehicles'));
    }
    
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

        if ($request->hasFile('image')) {
            if ($vehicle->image_path) {
                Storage::delete('public/' . $vehicle->image_path);
            }
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        } else {
            $imagePath = $vehicle->image_path;
        }

        $vehicle->update(array_merge($request->except('image'), ['image_path' => $imagePath]));

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
        $activeVehicleCount = Vehicle::where('current_status', 'active')->count();
        return response()->json(['activeVehicleCount' => $activeVehicleCount]);
    }
    

    
}
