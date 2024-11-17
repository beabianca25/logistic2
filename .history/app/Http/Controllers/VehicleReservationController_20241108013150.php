<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Vehicle_Reservation;
use App\Models\VehicleReservation;
use Illuminate\Http\Request;

class VehicleReservationController extends Controller
{
    public function index()
    {
        $reservations = Vehicle_Reservation::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('reservation.vehicle_reservation.index', compact('reservations'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();  // Assuming Vehicle model exists
    $drivers = Driver::all();    // Assuming Driver model exists
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

        Vehicle_Reservation::create($request->all());

        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation created successfully!');
    }

    public function show(Vehicle_Reservation $vehicleReservation)
    {
        return view('reservation.vehicle_reservation.show', compact('vehicleReservation'));
    }

    public function edit(Vehicle_Reservation $vehicleReservation)
    {
        $vehicles = Vehicle::all();
    $drivers = Driver::all();
    return view('reservation.vehicle_reservation.edit', compact('vehicleReservation', 'vehicles', 'drivers'));
    }

    public function update(Request $request, Vehicle_Reservation $vehicleReservation)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seats' => 'required|integer',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:available,booked,maintenance,inactive',
            'location' => 'nullable|string',
            'availability_date' => 'nullable|date',
        ]);

        $vehicleReservation->update($request->all());

        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy(Vehicle_Reservation $vehicleReservation)
    {
        $vehicleReservation->delete();
        return redirect()->route('vehicle_reservation.index')->with('success', 'Reservation deleted successfully!');
    }
}
