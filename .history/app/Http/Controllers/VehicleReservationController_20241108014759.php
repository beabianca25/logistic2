<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Vehicle_Reservation;
use App\Models\VehicleReservation;  // Correct model name
use Illuminate\Http\Request;

class VehicleReservationController extends Controller
{
    public function index()
    {
        $reservations = Vehicle_Reservation::all(); // Changed to VehicleReservation
        return view('reservation.vehicle_reservation.index', compact('reservations'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('reservation.vehicle_reservation.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seats' => 'required|integer',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:available,booked,maintenance,inactive',
            'location' => 'nullable|string',
            'availability_date' => 'nullable|date',
        ]);

        Vehicle_Reservation::create($request->all()); // Changed to VehicleReservation

        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation created successfully!');
    }

    public function show(Vehicle_Reservation $vehicle_reservation) // Changed to VehicleReservation
    {
        return view('reservation.vehicle_reservation.show', compact('vehicleReservation'));
    }

    public function edit(Vehicle_Reservation $vehicle_reservation) // Changed to VehicleReservation
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('reservation.vehicle_reservation.edit', compact('vehicleReservation', 'vehicles', 'drivers'));
    }

    public function update(Request $request, Vehicle_Reservation $vehicle_reservation) // Changed to VehicleReservation
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seats' => 'required|integer',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:available,booked,maintenance,inactive',
            'location' => 'nullable|string',
            'availability_date' => 'nullable|date',
        ]);

        $vehicle_reservation->update($request->all()); // Changed to VehicleReservation

        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy(Vehicle_Reservation $vehicle_reservation) // Changed to VehicleReservation
    {
        $vehicle_reservation->delete();
        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation deleted successfully!');
    }
}
