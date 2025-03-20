<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationVehicle;
use App\Models\VehicleReservation;
use App\Models\Vehicle;

class ReservationVehicleController extends Controller
{
    /**
     * Display a listing of the reservations with vehicles.
     */
    public function index()
    {
        $reservations = VehicleReservation::with('vehicles')->get();
        return view('Reservation.ReservationVehicle.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation with vehicles.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $reservations = VehicleReservation::all();
        return view('Reservation.ReservationVehicle.create', compact('vehicles', 'reservations'));
    }

    /**
     * Store a new reservation vehicle relation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_reservation_id' => 'required|exists:vehicle_reservations,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        ReservationVehicle::create([
            'vehicle_reservation_id' => $request->vehicle_reservation_id,
            'vehicle_id' => $request->vehicle_id,
        ]);

        return redirect()->route('reservationvehicle.index')->with('success', 'Vehicle assigned to reservation successfully.');
    }

    /**
     * Remove a vehicle from a reservation.
     */
    public function destroy($id)
    {
        $reservationVehicle = ReservationVehicle::findOrFail($id);
        $reservationVehicle->delete();

        return redirect()->route('reservationvehicle.index')->with('success', 'Vehicle removed from reservation.');
    }
}
