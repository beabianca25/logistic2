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
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'vin' => 'required|string|unique:vehicles',
            'registration_number' => 'required|string|unique:vehicles',
            'capacity' => 'required|integer',
            'image' => 'nullable|image|max:2048', // Optional image upload
            // Add validation for driver, trip, maintenance, fuel, and expense fields if needed
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicles', 'public');
        }

        // Create a new vehicle record
        Vehicle::create([
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'vin' => $request->vin,
            'registration_number' => $request->registration_number,
            'capacity' => $request->capacity,
            'current_status' => $request->current_status,
            'insurance_info' => $request->insurance_info,
            'image_path' => $imagePath,
            
            // Driver details
            'name' => $request->name,
            'license_number' => $request->license_number,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'address' => $request->address,
            'certifications' => $request->certifications,
            'license_expiry_date' => $request->license_expiry_date,
            'status' => $request->status,

            // Trip details
            'trip_starting_location' => $request->trip_starting_location,
            'trip_destination' => $request->trip_destination,
            'trip_departure_time' => $request->trip_departure_time,
            'trip_expected_arrival_time' => $request->trip_expected_arrival_time,
            'trip_status' => $request->trip_status,

            // Maintenance details
            'maintenance_type' => $request->maintenance_type,
            'maintenance_date' => $request->maintenance_date,
            'service_vendor' => $request->service_vendor,
            'maintenance_cost' => $request->maintenance_cost,
            'maintenance_status' => $request->maintenance_status,

            // Fuel records
            'fuel_refill_date' => $request->fuel_refill_date,
            'fuel_amount' => $request->fuel_amount,
            'fuel_cost' => $request->fuel_cost,
            'fuel_station' => $request->fuel_station,

            // Expense records
            'expense_type' => $request->expense_type,
            'expense_date' => $request->expense_date,
            'expense_amount' => $request->expense_amount,
            'expense_description' => $request->expense_description,
        ]);

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
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'vin' => 'required|string|unique:vehicles,vin,' . $id,
            'registration_number' => 'required|string|unique:vehicles,registration_number,' . $id,
            'capacity' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            // Add validation for other fields if needed
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

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
