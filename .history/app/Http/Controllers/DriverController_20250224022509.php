<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        $vehicles = Vehicle::all();
        return view('Fleet.Driver.index', compact('drivers', 'vehicles'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('Fleet.Driver.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'driver_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'national_id_number' => 'nullable|string|unique:drivers,national_id_number',
            'license_number' => 'required|string|unique:drivers,license_number',
            'license_category' => 'nullable|in:A,B,C,D,E',
            'license_expiry_date' => 'nullable|date',
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'employment_status' => 'required|in:Full-Time,Part-Time,Contract,Temporary',
            'hire_date' => 'nullable|date',
            'termination_date' => 'nullable|date',
            'driving_experience_years' => 'nullable|integer',
            'assigned_routes' => 'nullable|string',
            'certifications' => 'nullable|string',
            'background_check_status' => 'nullable|boolean',
            'accident_history' => 'nullable|string',
            'training_completed' => 'nullable|string',
            'violation_records' => 'nullable|string',
            'medical_fitness_certificate' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'blood_type' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'remarks' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload profile picture
        $imagePath = $request->hasFile('profile_picture') 
            ? $request->file('profile_picture')->store('driver_images', 'public') 
            : null;

        // Upload medical fitness certificate
        $certificatePath = $request->hasFile('medical_fitness_certificate') 
            ? $request->file('medical_fitness_certificate')->store('medical_certificates', 'public') 
            : null;

        // Create driver record
        Driver::create(array_merge($request->all(), [
            'profile_picture' => $imagePath,
            'medical_fitness_certificate' => $certificatePath,
        ]));

        return redirect()->route('driver.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver)
    {
        return view('Fleet.Driver.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $vehicles = Vehicle::all();
        return view('Fleet.Driver.edit', compact('driver', 'vehicles'));
    }

    public function update(Request $request, Driver $driver)
    {

        dd($request->all());
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'driver_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'national_id_number' => 'nullable|string|unique:drivers,national_id_number,' . $driver->id,
            'license_number' => 'required|string|unique:drivers,license_number,' . $driver->id,
            'license_category' => 'nullable|in:A,B,C,D,E',
            'license_expiry_date' => 'nullable|date',
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'employment_status' => 'required|in:Full-Time,Part-Time,Contract,Temporary',
            'hire_date' => 'nullable|date',
            'termination_date' => 'nullable|date',
            'driving_experience_years' => 'nullable|integer',
            'assigned_routes' => 'nullable|string',
            'certifications' => 'nullable|string',
            'background_check_status' => 'nullable|boolean',
            'accident_history' => 'nullable|string',
            'training_completed' => 'nullable|string',
            'violation_records' => 'nullable|string',
            'medical_fitness_certificate' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'blood_type' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'remarks' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            if ($driver->profile_picture && Storage::exists('public/' . $driver->profile_picture)) {
                Storage::delete('public/' . $driver->profile_picture);
            }
            $imagePath = $request->file('profile_picture')->store('driver_images', 'public');
        } else {
            $imagePath = $driver->profile_picture;
        }

        // Handle medical fitness certificate update
        if ($request->hasFile('medical_fitness_certificate')) {
            if ($driver->medical_fitness_certificate && Storage::exists('public/' . $driver->medical_fitness_certificate)) {
                Storage::delete('public/' . $driver->medical_fitness_certificate);
            }
            $certificatePath = $request->file('medical_fitness_certificate')->store('medical_certificates', 'public');
        } else {
            $certificatePath = $driver->medical_fitness_certificate;
        }

        $driver->update(array_merge($request->all(), [
            'status' => $request->status,
            'profile_picture' => $imagePath,
            'medical_fitness_certificate' => $certificatePath,
        ]));

        $driver->status = $request->input('status');
        $driver->save();


        return redirect()->route('driver.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->profile_picture && Storage::exists('public/' . $driver->profile_picture)) {
            Storage::delete('public/' . $driver->profile_picture);
        }

        if ($driver->medical_fitness_certificate && Storage::exists('public/' . $driver->medical_fitness_certificate)) {
            Storage::delete('public/' . $driver->medical_fitness_certificate);
        }

        $driver->delete();

        return redirect()->route('driver.index')->with('success', 'Driver deleted successfully.');
    }

    // Method to download Medical Fitness Certificate
    public function downloadCertificate(Driver $driver)
    {
        if (!$driver->medical_fitness_certificate || !Storage::exists('public/' . $driver->medical_fitness_certificate)) {
            return redirect()->route('driver.index')->with('error', 'Medical Fitness Certificate not found.');
        }

        return response()->download(storage_path('app/public/' . $driver->medical_fitness_certificate));
    }
}
