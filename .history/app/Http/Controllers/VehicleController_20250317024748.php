<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleLocation;
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

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id); // Fetch the specific vehicle
        $vehicles = Vehicle::all(); // Fetch all vehicles
    
        return view('Fleet.Vehicle.show', compact('vehicle', 'vehicles'));
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
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle image update
        if ($request->hasFile('image_path')) {
            if ($vehicle->image_path) {
                Storage::delete('public/' . $vehicle->image_path);
            }
            $imagePath = $request->file('image_path')->store('vehicle_images', 'public');
        } else {
            $imagePath = $vehicle->image_path;
        }
    
        // Update vehicle details
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
        $vehicles = Vehicle::where('current_status', 'Active')->orderBy('model', 'asc')->get();
        return view('PublicShow.publicvehicle', compact('vehicles'));
    }
    

    public function getActiveVehicleCount()
    {
        $activeVehicleCount = Vehicle::where('current_status', 'Active')->count();
        return response()->json(['activeVehicleCount' => $activeVehicleCount]);
    }


  public function storeLocation(Request $request, $id) {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        VehicleLocation::create([
            'vehicle_id' => $id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('vehicle.location', $id)->with('success', 'Location updated successfully.');
    }


    public function showLocation($vehicleId)
    {
        // Fetch the latest location for the vehicle
        $latestLocation = VehicleLocation::where('vehicle_id', $vehicleId)
            ->latest('recorded_at')
            ->first();
    
        if (!$latestLocation) {
            return abort(404, "Location not found for this vehicle.");
        }
    
        return response()->json([
            'vehicle_id' => $vehicleId,
            'latitude' => $latestLocation->latitude,
            'longitude' => $latestLocation->longitude,
            'recorded_at' => $latestLocation->recorded_at,
        ]);
    }
    
    public function getVehicleLocations()
    {
        $vehicles = Vehicle::with(['locations' => function ($query) {
            $query->latest()->limit(1); // Get latest location
        }])->get();
    
        return response()->json($vehicles);
    }
    
public function locationHistory($id) {
    $vehicle = Vehicle::with('locations')->findOrFail($id);
    return view('Fleet.Vehicle.locationhistory', compact('vehicle'));
}

public function locationForm(Vehicle $vehicle)
{
    return view('Fleet.Vehicle.location', compact('vehicle'));
}



}
