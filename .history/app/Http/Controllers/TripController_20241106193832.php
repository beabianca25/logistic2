<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with('vehicle')->get();
        return view('fleet.trip.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all(); // Retrieve all vehicles for dropdown
        return view('fleet.trip.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'starting_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'expected_arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|in:scheduled,ongoing,completed,delayed',
        ]);

        Trip::create($request->all());

        return redirect()->route('trip.index')->with('success', 'Trip created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return view('trip.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $vehicles = Vehicle::all();
        return view('fleet.trip.edit', compact('trip', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'starting_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'expected_arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|in:scheduled,ongoing,completed,delayed',
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
