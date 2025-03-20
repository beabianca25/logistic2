<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRelease;
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
        $releases = VehicleRelease::with('reservation.vehicle')->get(); // Eager load reservation and vehicle details
        return view('Reservation.Release.index', compact('releases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservations = VehicleReservation::where('status', 'Approved')->with('vehicles')->get();
        return view('Reservation.Release.create', compact('reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_reservation_id' => 'required|exists:vehicle_reservations,id',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'reservation_date' => 'required|date',
            'release_date' => 'required|date',
            'drop_off_date' => 'nullable|date|after_or_equal:release_date',
            'released_by' => 'required|string|max:255',
            'condition_report' => 'nullable|string',
            'total_cost' => 'required|numeric',
            'payment_status' => 'boolean',
            'status' => 'required|in:Pending,Ongoing,Completed,Cancelled',
            'notes' => 'nullable|string',
        ]);

        VehicleRelease::create($validatedData);
        return redirect()->route('vehicle_releases.index')->with('success', 'Vehicle released successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $release = VehicleRelease::with('reservation.vehicle')->findOrFail($id);
        return view('Reservation.Release.show', compact('release'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $release = VehicleRelease::with('reservation.vehicle')->findOrFail($id);
        $reservations = VehicleReservation::where('status', 'Approved')->with('vehicle')->get();
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
            'reservation_date' => 'required|date',
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
}
