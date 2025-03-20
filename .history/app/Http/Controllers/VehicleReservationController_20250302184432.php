<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;

class VehicleReservationController extends Controller
{
    public function index()
    {
        $reservations = VehicleReservation::with(['vehicles', 'driver', 'user'])->get();
        $reservationCount = VehicleReservation::count(); // Count total reservations
        return view('Reservation.VehicleReservation.index', compact('reservations'));
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
    
        // Generate unique reference code
        $referenceCode = 'RES-' . strtoupper(Str::random(8));
    
        // Create reservation
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
    
        // Attach vehicles to pivot table
        $reservation->vehicles()->attach($request->vehicle_ids);
    
        return redirect()->route('reservation.index')->with('success', 'Reservation created successfully!');
    }
    
    public function show(VehicleReservation $reservation)
    {
        $reservation->load('vehicles'); // Load related vehicles
        return view('Reservation.VehicleReservation.show', compact('reservation'));
    }
    

    public function edit(VehicleReservation $reservation)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('Reservation.VehicleReservation.edit', compact('reservation', 'vehicles', 'drivers'));
    }

    public function update(Request $request, $id)
    {
        $reservation = VehicleReservation::find($id);
    
        if (!$reservation) {
            return back()->with('error', 'Reservation not found.');
        }
    
        // Validate incoming request
        $request->validate([
            'customer_name' => 'nullable|string',
            'customer_contact' => 'nullable|string',
            'location' => 'nullable|string',
            'reservation_notes' => 'nullable|string',
            'vehicle_ids' => 'nullable|array',
            'driver_id' => 'required|exists:drivers,id',
            'reservation_start_date' => 'required|date',
            'reservation_end_date' => 'required|date',
            'status' => 'required|in:Pending,Approved,Completed,Cancelled',
            'total_price' => 'nullable|numeric',
        ]);
    
        // Update fields
        $reservation->update([
            'customer_name' => $request->customer_name,
            'customer_contact' => $request->customer_contact,
            'location' => $request->location,
            'reservation_notes' => $request->reservation_notes,
            'vehicle_ids' => json_encode($request->vehicle_ids), // Ensure JSON storage
            'driver_id' => $request->driver_id,
            'reservation_start_date' => $request->reservation_start_date,
            'reservation_end_date' => $request->reservation_end_date,
            'status' => $request->status, // Ensure status is updated
            'total_price' => $request->total_price,
        ]);
    
        return  redirect()->route('reservation.index')->with('success', 'Reservation updated successfully.');
    }
    
    
    
    
    public function destroy(VehicleReservation $reservation)
    {
        // Detach related vehicles before deleting the reservation
        $reservation->vehicles()->detach();
        
        $reservation->delete();

        return redirect()->route('reservation.index')->with('success', 'Reservation deleted successfully!');
    }
}
