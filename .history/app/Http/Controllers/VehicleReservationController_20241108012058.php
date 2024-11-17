<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_Reservation;
use App\Models\VehicleReservation;
use Illuminate\Http\Request;

class VehicleReservationController extends Controller
{
    public function index()
    {
        $reservations = Vehicle_Reservation::all();
        return view('vehicle_reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('vehicle_reservations.create');
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

        return redirect()->route('vehicle_reservations.index')->with('success', 'Reservation created successfully!');
    }

    public function show(Vehicle_Reservation $vehicleReservation)
    {
        return view('vehicle_reservations.show', compact('vehicleReservation'));
    }

    public function edit(Vehicle_Reservation $vehicleReservation)
    {
        return view('vehicle_reservations.edit', compact('vehicleReservation'));
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

        return redirect()->route('vehicle_reservations.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy(Vehicle_Reservation $vehicleReservation)
    {
        $vehicleReservation->delete();
        return redirect()->route('vehicle_reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
