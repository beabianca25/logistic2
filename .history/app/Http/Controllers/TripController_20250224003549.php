<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all(); // Include drivers for selection

        return view('Fleet.Trip.index', compact('trips', 'vehicles', 'drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        
        return view('Fleet.Trip.create', compact('vehicles', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'starting_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'trip_type' => 'required|in:One-Way,Round-Trip,Multi-Stop',
            'departure_time' => 'required|date',
            'expected_arrival_time' => 'required|date|after:departure_time',
            'actual_departure_time' => 'nullable|date',
            'actual_arrival_time' => 'nullable|date',
            'route_details' => 'nullable|string',
            'distance_km' => 'nullable|numeric',
            'passenger_count' => 'nullable|integer',
            'fuel_consumed' => 'nullable|numeric',
            'fuel_cost' => 'nullable|numeric',
            'trip_expenses' => 'nullable|numeric',
            'gps_tracking_id' => 'nullable|string',
            'incident_report' => 'nullable|string',
            'weather_conditions' => 'nullable|string',
            'delay_reason' => 'nullable|string',
            'cargo_details' => 'nullable|string',
            'trip_notes' => 'nullable|string',
            'status' => 'required|in:Scheduled,Ongoing,Completed,Delayed',
        ]);

        Trip::create($request->all());

        return redirect()->route('trip.index')->with('success', 'Trip created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return view('Fleet.Trip.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('Fleet.Trip.edit', compact('trip', 'vehicles', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'starting_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'trip_type' => 'required|in:One-Way,Round-Trip,Multi-Stop',
            'departure_time' => 'required|date',
            'expected_arrival_time' => 'required|date|after:departure_time',
            'actual_departure_time' => 'nullable|date',
            'actual_arrival_time' => 'nullable|date',
            'route_details' => 'nullable|string',
            'distance_km' => 'nullable|numeric',
            'passenger_count' => 'nullable|integer',
            'fuel_consumed' => 'nullable|numeric',
            'fuel_cost' => 'nullable|numeric',
            'trip_expenses' => 'nullable|numeric',
            'gps_tracking_id' => 'nullable|string',
            'incident_report' => 'nullable|string',
            'weather_conditions' => 'nullable|string',
            'delay_reason' => 'nullable|string',
            'cargo_details' => 'nullable|string',
            'trip_notes' => 'nullable|string',
            'status' => 'required|in:Scheduled,Ongoing,Completed,Delayed',
        ]);

        $trip->update($request->all());

        return redirect()->route('trip.index')->with('success', 'Trip updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('trip.index')->with('success', 'Trip deleted successfully.');
    }
}
