<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required',
            'model' => 'required',
            'manufacturer' => 'required',
            'year_of_manufacture' => 'required|integer',
            'license_plate' => 'required|unique:vehicles',
            'capacity' => 'required|integer',
            'current_status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image') 
            ? $request->file('image')->store('vehicle_images', 'public')
            : null;

        Vehicle::create([
            'vehicle_type' => $request->vehicle_type,
            'model' => $request->model,
            'manufacturer' => $request->manufacturer,
            'year_of_manufacture' => $request->year_of_manufacture,
            'license_plate' => $request->license_plate,
            'capacity' => $request->capacity,
            'current_status' => $request->current_status,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_type' => 'required',
            'model' => 'required',
            'license_plate' => 'required|unique:vehicles,license_plate,' . $vehicle->id,
            'capacity' => 'required|integer',
            'current_status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($vehicle->image_path) {
                Storage::delete('public/' . $vehicle->image_path);
            }
            $imagePath = $request->file('image')->store('vehicle_images', 'public');
        } else {
            $imagePath = $vehicle->image_path;
        }

        $vehicle->update([
            'vehicle_type' => $request->vehicle_type,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'capacity' => $request->capacity,
            'current_status' => $request->current_status,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->image_path) {
            Storage::delete('public/' . $vehicle->image_path);
        }
        
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully!');
    }
}
