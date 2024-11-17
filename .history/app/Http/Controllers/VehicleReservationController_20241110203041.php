<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Vehicle_Reservation;
use Illuminate\Http\Request;

class VehicleReservationController extends Controller
{
    public function index()
    {
        // Fetch all reservations, vehicles, and drivers
        $reservations = Vehicle_Reservation::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        // Return the index view with the data
        return view('reservation.vehicle_reservation.index', compact('reservations', 'vehicles', 'drivers'));
    }

    public function create()
    {
        // Fetch all vehicles and drivers for the reservation form
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        // Return the create view with the data
        return view('reservation.vehicle_reservation.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seats' => 'required|integer',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:available,booked,maintenance,inactive',
            'location' => 'nullable|string',
            'availability_date' => 'nullable|date',
        ], [
            'vehicle_id.required' => 'Please select a vehicle.',
            'driver_id.required' => 'Please select a driver.',
            'seats.required' => 'Please specify the number of seats.',
            'status.required' => 'Please select the reservation status.',
        ]);

        // Create the reservation record in the database
        Vehicle_Reservation::create([
            'vehicle_id' => $request->vehicle_id,
            'seats' => $request->seats,
            'driver_id' => $request->driver_id,
            'status' => $request->status,
            'location' => $request->location,
            'availability_date' => $request->availability_date,
        ]);

        // Redirect with success message
        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation created successfully!');
    }

    public function show(Vehicle_Reservation $reservation)
    {
        // Return the show view with the reservation data
        return view('reservation.vehicle_reservation.show', compact('reservation'));
    }

    public function edit(Vehicle_Reservation $reservation)
    {
        // Fetch all vehicles and drivers for the edit form
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        // Return the edit view with the reservation, vehicles, and drivers data
        return view('reservation.vehicle_reservation.edit', compact('reservation', 'vehicles', 'drivers'));
    }

    public function update(Request $request, Vehicle_Reservation $reservation)
    {
        // Validate the incoming request
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seats' => 'required|integer',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:available,booked,maintenance,inactive',
            'location' => 'nullable|string',
            'availability_date' => 'nullable|date',
        ], [
            'vehicle_id.required' => 'Please select a vehicle.',
            'driver_id.required' => 'Please select a driver.',
            'seats.required' => 'Please specify the number of seats.',
            'status.required' => 'Please select the reservation status.',
        ]);

        // Update the reservation record in the database
        $reservation->update([
            'vehicle_id' => $request->vehicle_id,
            'seats' => $request->seats,
            'driver_id' => $request->driver_id,
            'status' => $request->status,
            'location' => $request->location,
            'availability_date' => $request->availability_date,
        ]);

        // Redirect with success message
        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy(Vehicle_Reservation $reservation)
    {
        // Delete the reservation record from the database
        $reservation->delete();

        // Redirect with success message
        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation deleted successfully!');
    }
}
