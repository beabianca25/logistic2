<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('fleet.driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('fleet.driver.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:drivers',
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'license_expiry_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        Driver::create($request->all());

        return redirect()->route('driver.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver)
    {
        return view('fleet.driver.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('fleet.driver.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:drivers,license_number,' . $driver->id,
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'license_expiry_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        $driver->update($request->all());

        return redirect()->route('driver.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('driver.index')->with('success', 'Driver deleted successfully.');
    }
}
