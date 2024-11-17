<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('driver', 'vehicle')->paginate(10); // Eager load the driver relation
        return view('reservation.car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        return view('reservation.car.create', compact('drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'registration_number' => 'required|string|max:255|unique:cars',
            'seats' => 'required|integer|min:1',
            'driver_id' => 'required|exists:drivers,id',
            'category' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('car_pictures', 'public');
        }

        // Create a new car record
        // Car::create([
        //     'vehicle_id' => $request->vehicle_id,
        //     'registration_number' => $request->registration_number,
        //     'seats' => $request->seats,
        //     'driver_id' => $request->driver_id,
        //     'category' => $request->category,
        //     'status' => $request->status,
        //     'picture' => $picturePath,
        // ]);

        $car = new Car();
        $car->vehicle_id = $request->input('vehicle_id');
        $car->registration_number = $request->input('registration_number');
        $car->seats = $request->input('seats');
        $car->driver_id = $request->input('driver_id');
        $car->category = $request->input('category');
        $car->status = $request->input('status');
        $car->picture = $request->input('picture');
        // $car->status = 'scheduled';

        $car->save();

        return redirect()->route('car.index')->with('success', 'Vehicle created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('reservation.car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $vehicles = Vehicle::all();
        return view('reservation.car.edit', compact('car', 'vehicles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([

            'vehicle_id' => 'required|exists:vehicle,id',
            'registration_number' => 'required|string|max:255|unique:cars,registration_number,' . $car->id,
            'seats' => 'required|integer',
            'driver_id' => 'required|exists:drivers,id',
            'category' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $picturePath = $car->picture; // Keep the existing picture
        if ($request->hasFile('picture')) {
            // Optionally, delete the old picture if needed
            // Storage::disk('public')->delete($car->picture); // Uncomment if you want to delete old image

            $picturePath = $request->file('picture')->store('car_pictures', 'public');
        }

        $car->update([
            'registration_number' => $request->registration_number,
            'seats' => $request->seats,
            'driver_id' => $request->driver_id,
            'category' => $request->category,
            'status' => $request->status,
            'picture' => $picturePath,
        ]);

        return redirect()->route('car.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('car.index')->with('success', 'Vehicle deleted successfully.');
    }
}
