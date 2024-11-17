<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Vehicle_Release;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class VehicleReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $vehicles = Vehicle::all();  // Retrieve all vehicles
    $releases = Vehicle_Release::all();
    return view('Reservation.Release.index', compact('vehicles'));  // Pass vehicles to the view
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all(); // Fetch all vehicles
        return view('reservation.release.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'reservation_date' => 'required|date',
            'release_date' => 'required|date',
            'drop_off_date' => 'nullable|date|after_or_equal:release_date',
            'released_by' => 'required|string|max:255',
            'condition_report' => 'nullable|string',
            'total_cost' => 'required|numeric',
            'payment_status' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $release = Vehicle_Release::create($validatedData);
        return redirect()->route('release.index')->with('success', 'Vehicle released successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $release = Vehicle_Release::with('vehicle')->findOrFail($id); // Use eager loading for the vehicle relationship
        return view('reservation.release.show', compact('release'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $release = Vehicle_Release::with('vehicle')->findOrFail($id); // Eager load the vehicle relationship
        $vehicles = Vehicle::all(); // Retrieve all vehicles

        return view('reservation.release.edit', compact('release', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'customer_name' => 'required|string|max:255',
        'customer_contact' => 'required|string|max:255',
        'reservation_date' => 'required|date',
        'release_date' => 'required|date',
        'drop_off_date' => 'nullable|date',
        'released_by' => 'required|string|max:255',
        'condition_report' => 'nullable|string',
        'total_cost' => 'required|numeric',
        'payment_status' => 'required|boolean',
        'notes' => 'nullable|string',
    ]);

    // Find the release by ID
    $release = Vehicle_Release::findOrFail($id);

    // Update the release with validated data
    $release->update($validatedData);

    // Redirect back to the index or show a success message
    return redirect()->route('release.index')->with('success', 'Release updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle_Release $vehicle_release)
    {
        Log::info("Attempting to delete release with ID: {$vehicle_release}");

        $release = Vehicle_Release::find($vehicle_release);
    
        if (!$release) {
            Log::error("Release not found: {$vehicle_release}");
            return redirect()->route('release.index')->with('error', 'Release not found.');
        }
    
        $release->delete();
        Log::info("Successfully deleted release with ID: {$vehicle_release}");
    
        return redirect()->route('release.index')->with('success', 'Release deleted successfully.');
    }
}
