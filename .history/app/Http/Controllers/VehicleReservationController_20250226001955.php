<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleReservationController extends Controller
{
    public function index()
    {
        // Eager load relationships to optimize queries
        $reservations = VehicleReservation::with(['vehicles', 'driver', 'user'])->get();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('Reservation.VehicleReservation.index', compact('reservations', 'vehicles', 'drivers'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('Reservation.VehicleReservation.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'nullable|string',
            'customer_contact' => 'nullable|string',
            'vehicle_count' => 'required|integer|min:1',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:Pending,Approved,Completed,Cancelled',
            'location' => 'nullable|string',
            'reservation_notes' => 'nullable|string',
            'reservation_start_date' => 'required|date',
            'reservation_end_date' => 'required|date|after_or_equal:reservation_start_date',
            'total_price' => 'nullable|numeric|min:0',
            'user_id' => 'nullable|exists:users,id',
            'vehicle_ids' => 'required|array',
            'vehicle_ids.*' => 'exists:vehicles,id',
        ]);
        
        dd($request->all()); // Dump all request data to check if it’s being passed correctly
        

        // Generate a unique reference code
        $referenceCode = 'RES-' . strtoupper(Str::random(8));

        // Create the reservation
        $reservation = VehicleReservation::create([
            'reference_code' => $referenceCode,
            'customer_name' => $request->customer_name,
            'customer_contact' => $request->customer_contact,
            'vehicle_count' => count($request->vehicle_ids),
            'driver_id' => $request->driver_id,
            'status' => $request->status,
            'location' => $request->location,
            'reservation_notes' => $request->reservation_notes,
            'reservation_start_date' => $request->reservation_start_date,
            'reservation_end_date' => $request->reservation_end_date,
            'total_price' => $request->total_price,
            'user_id' => $request->user_id,
        ]);

        // Attach selected vehicles to the reservation
        $reservation->vehicles()->attach($request->vehicle_ids);

        return redirect()->route('reservation.index')->with('success', 'Reservation created successfully!');
    }

    public function show(VehicleReservation $reservation)
    {
        return view('Reservation.VehicleReservation.show', compact('reservation'));
    }

    public function edit(VehicleReservation $reservation)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('Reservation.VehicleReservation.edit', compact('reservation', 'vehicles', 'drivers'));
    }

    public function update(Request $request, VehicleReservation $reservation)
    {
        $request->validate([
            'customer_name' => 'nullable|string',
            'customer_contact' => 'nullable|string',
            'vehicle_count' => 'required|integer|min:1',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:Pending,Approved,Completed,Cancelled',
            'location' => 'nullable|string',
            'reservation_notes' => 'nullable|string',
            'reservation_start_date' => 'required|date',
            'reservation_end_date' => 'required|date|after_or_equal:reservation_start_date',
            'total_price' => 'nullable|numeric|min:0',
            'user_id' => 'nullable|exists:users,id',
            'vehicle_ids' => 'required|array',
            'vehicle_ids.*' => 'exists:vehicles,id',
        ]);

        // Update reservation details
        $reservation->update([
            'customer_name' => $request->customer_name,
            'customer_contact' => $request->customer_contact,
            'vehicle_count' => count($request->vehicle_ids),
            'driver_id' => $request->driver_id,
            'status' => $request->status,
            'location' => $request->location,
            'reservation_notes' => $request->reservation_notes,
            'reservation_start_date' => $request->reservation_start_date,
            'reservation_end_date' => $request->reservation_end_date,
            'total_price' => $request->total_price,
            'user_id' => $request->user_id,
        ]);

        // Sync selected vehicles
        $reservation->vehicles()->sync($request->vehicle_ids);

        return redirect()->route('reservation.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy(VehicleReservation $reservation)
    {
        $reservation->vehicles()->detach(); // Detach vehicles before deleting
        $reservation->delete();

        return redirect()->route('reservation.index')->with('success', 'Reservation deleted successfully!');
    }
}
