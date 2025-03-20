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
        // Debugging: Show all request data
        dd($request->all());
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'service_type' => 'required|string',
            'venue_name' => 'nullable|string|max:255',
            'number_of_people' => 'nullable|integer',
            'destination' => 'nullable|string|max:255',
            'pickup_location' => 'nullable|string|max:255',
            'dropoff_location' => 'nullable|string|max:255',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'special_requests' => 'nullable|string',
            'booking_date' => 'required|date',
            'status' => 'required|in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled',
            'payment_status' => 'required|in:Pending,Paid,Cancelled',
        ]);
    
        Booking::create($validated);
    
        return redirect()->route('booking.index')->with('success', 'Booking created successfully!');
    }
    


    public function show(Booking $booking)
    {
        return view('Vendor.Booking.show', compact('booking')); // Return a view for a single booking
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
