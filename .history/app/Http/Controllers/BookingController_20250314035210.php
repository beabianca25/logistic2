<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('Vendor.Booking.index', compact('bookings'));
    }

    public function create()
    {
        return view('Vendor.Booking.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'service_type' => 'required|string',

            // Nullable Fields
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

            // New Field: Start Date
            'start_date' => 'nullable|date|after_or_equal:today', // Ensures start date is today or future

            // Additional Fields
            'price' => 'nullable|numeric',
            'status' => 'required|in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled',
            'payment_status' => 'required|in:Pending,Paid,Cancelled',
        ]);

        Booking::create($validated);

        return redirect()->route('booking.index')->with('success', 'Booking created successfully!');
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('Vendor.Booking.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('Vendor.Booking.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled',
            'payment_status' => 'required|in:Pending,Paid,Cancelled',
            'start_date' => 'nullable|date|after_or_equal:today', // Allow updating start date
        ]);

        $booking->update($validated);
        return redirect()->route('booking.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
    
        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }
    
}
