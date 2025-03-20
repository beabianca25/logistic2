<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRelease;
use App\Models\VehicleReleaseHistory;
use App\Models\VehicleReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VehicleReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $releases = VehicleRelease::with('reservation')->get(); // Remove vehicle if not needed
        return view('Reservation.Release.index', compact('releases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $reservations = VehicleReservation::where('status', 'Approved')
        ->select('id', 'reference_code', 'customer_name', 'customer_contact', 'reservation_start_date')
        ->get()
        ->map(function ($reservation) {
            $reservation->reservation_start_date = optional($reservation->reservation_start_date)->format('Y-m-d');
            return $reservation;
        });
    
    
        return view('Reservation.Release.create', compact('reservations'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate only fields that need user input
        $validatedData = $request->validate([
            'vehicle_reservation_id' => 'required|exists:vehicle_reservations,id',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'release_date' => 'required|date',
            'drop_off_date' => 'nullable|date|after_or_equal:release_date',
            'released_by' => 'required|string|max:255',
            'condition_report' => 'nullable|string',
            'total_cost' => 'required|numeric',
            'payment_status' => 'boolean',
            'status' => 'required|in:Pending,Ongoing,Completed,Cancelled',
            'notes' => 'nullable|string',
        ]);
    
        // Retrieve reservation_start_date from the vehicle_reservations table
        $reservation = VehicleReservation::findOrFail($request->vehicle_reservation_id);
    
        // Add reservation_start_date automatically
        $validatedData['reservation_start_date'] = $reservation->reservation_start_date;
    
        // Create the vehicle release record
        VehicleRelease::create($validatedData);
    
        return redirect()->route('release.index')->with('success', 'Vehicle released successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $release = VehicleRelease::with('reservation')->findOrFail($id); // Remove vehicle
        return view('Reservation.Release.show', compact('release'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $release = VehicleRelease::with('reservation')->findOrFail($id); // Remove vehicle
        $reservations = VehicleReservation::where('status', 'Approved')->get();
        return view('Reservation.Release.edit', compact('release', 'reservations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vehicle_reservation_id' => 'required|exists:vehicle_reservations,id',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'reservation_start_date' => 'required|date',
            'release_date' => 'required|date',
            'drop_off_date' => 'nullable|date|after_or_equal:release_date',
            'released_by' => 'required|string|max:255',
            'condition_report' => 'nullable|string',
            'total_cost' => 'required|numeric',
            'payment_status' => 'required|boolean',
            'status' => 'required|in:Pending,Ongoing,Completed,Cancelled',
            'notes' => 'nullable|string',
        ]);

        $release = VehicleRelease::findOrFail($id);
        $release->update($validatedData);

        return redirect()->route('vehicle_releases.index')->with('success', 'Vehicle release updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $release = VehicleRelease::findOrFail($id);
        $release->delete();

        return redirect()->route('vehicle_releases.index')->with('success', 'Vehicle release deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $release = VehicleRelease::findOrFail($id);
        $release->update(['status' => 'Completed']);

        return redirect()->back()->with('success', 'Vehicle release marked as completed and moved to history.');
    }


    public function markAsCompleted($id)
    {
        // Find the vehicle release record
        $release = VehicleRelease::findOrFail($id);

        // Move the record to history
        $history = new VehicleReleaseHistory($release->toArray());
        $history->vehicle_release_id = $release->id; // Set foreign key
        $history->status = 'Completed'; // Ensure status is set correctly
        $history->save();

        // Delete the record from vehicle_releases table
        $release->delete();

        return redirect()->back()->with('success', 'Vehicle release marked as completed and moved to history.');
    }
}
