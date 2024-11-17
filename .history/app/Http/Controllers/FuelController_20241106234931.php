<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::with('vehicle')->get();
        return view('fuel.index', compact('fuels'));
    }

    public function create()
    {
        $vehicles = Vehicle::all(); // To list vehicles if needed
        return view('fuel.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'refill_date' => 'required|date',
            'fuel_amount' => 'required|numeric',
            'cost' => 'required|numeric',
            'fuel_station' => 'required|string',
            'status' => 'in:pending,completed',
        ]);

        Fuel::create($request->all());
        return redirect()->route('fuel.index')->with('success', 'Fuel refill record created successfully.');
    }

    public function show(Fuel $fuel)
    {
        return view('fuel.show', compact('fuel'));
    }

    public function edit(Fuel $fuel)
    {
        $vehicles = Vehicle::all();
        return view('fuel.edit', compact('fuel', 'vehicles'));
    }

    public function update(Request $request, Fuel $fuel)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'refill_date' => 'required|date',
            'fuel_amount' => 'required|numeric',
            'cost' => 'required|numeric',
            'fuel_station' => 'required|string',
            'status' => 'in:pending,completed',
        ]);

        $fuel->update($request->all());
        return redirect()->route('fuel.index')->with('success', 'Fuel refill record updated successfully.');
    }

    public function destroy(Fuel $fuel)
    {
        $fuel->delete();
        return redirect()->route('fuel.index')->with('success', 'Fuel refill record deleted successfully.');
    }
}
