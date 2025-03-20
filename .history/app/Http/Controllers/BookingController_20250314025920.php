<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('Vendor.Booking.index', compact('bookings')); // Return a view with all bookings
    }

    public function create()
    {
        return view('Vendor.Booking.create'); // Return a view for creating a booking
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'service_type' => 'required|string',

        // Nullable Fields (Explicitly Set Default Null)
        'venue_name' => 'nullable|string|max:255',
        'number_of_participants' => 'nullable|integer',
        'number_of_guests' => 'nullable|integer',
        'ceremony_venue' => 'nullable|string|max:255',
        'reception_venue' => 'nullable|string|max:255',
        'guest_count' => 'nullable|integer',
        'activities_preferred' => 'nullable|string',
        'event_date' => 'nullable|date',
        'seating_preference' => 'nullable|string|max:255',
        'school_group_name' => 'nullable|string|max:255',
        'destination' => 'nullable|string|max:255',
        'number_of_students' => 'nullable|integer',
        'departure_date' => 'nullable|date',
        'return_date' => 'nullable|date',
        'passenger_count' => 'nullable|integer',
        'number_of_travelers' => 'nullable|integer',
        'accommodation_preference' => 'nullable|string|max:255',
        'pickup_location' => 'nullable|string|max:255',
        'dropoff_location' => 'nullable|string|max:255',
        'number_of_seats' => 'nullable|integer',

        // Additional Fields
        'price' => 'nullable|numeric',
        'status' => 'required|in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled',
        'payment_status' => 'required|in:Pending,Paid,Cancelled',
    ]);

    // Ensure null values are explicitly set
    foreach ($validated as $key => $value) {
        if ($value === null) {
            $validated[$key] = null;
        }
    }

    Booking::create($validated);

    return redirect()->route('booking.index')->with('success', 'Booking created successfully!');
}

public function show($id)
{
    $booking = Booking::findOrFail($id);

    dd($booking->toArray()); // Debugging

    return view('booking.show', compact('booking'));
}

    public function edit(Booking $booking)
    {
        return view('Vendor.Booking.edit', compact('booking')); // Return a view for editing a booking
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled',
            'payment_status' => 'required|in:Pending,Paid,Cancelled',
        ]);

        $booking->update($validated);
        return redirect()->route('booking.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }
}
