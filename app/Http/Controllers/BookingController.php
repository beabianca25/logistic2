<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Notifications\BookingStatusNotification;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'service_type' => 'required|string',
            'destination' => 'nullable|string|max:255',
            'start_date' => 'nullable|date|after_or_equal:today',
            'status' => 'required|in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled',
            'payment_status' => 'required|in:Pending,Paid,Cancelled',
    
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
            'number_of_students' => 'nullable|integer',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'passenger_count' => 'nullable|integer',
            'number_of_travelers' => 'nullable|integer',
            'accommodation_preference' => 'nullable|string|max:255',
            'pickup_location' => 'nullable|string|max:255',
            'dropoff_location' => 'nullable|string|max:255',
            'number_of_seats' => 'nullable|integer',
            'price' => 'nullable|numeric',
        ]);
    
        Booking::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
            'service_type' => $request->service_type,
            'destination' => $request->destination,
            'start_date' => $request->start_date,
            'status' => $request->status,
            'payment_status' => $request->payment_status,
            'pickup_location' => $request->pickup_location,
            'dropoff_location' => $request->dropoff_location,
            'departure_date' => $request->departure_date,
            'return_date' => $request->return_date,
            'venue_name' => $request->venue_name,
            'number_of_participants' => $request->number_of_participants,
            'number_of_guests' => $request->number_of_guests,
            'ceremony_venue' => $request->ceremony_venue,
            'reception_venue' => $request->reception_venue,
            'guest_count' => $request->guest_count,
            'activities_preferred' => $request->activities_preferred,
            'event_date' => $request->event_date,
            'seating_preference' => $request->seating_preference,
            'school_group_name' => $request->school_group_name,
            'number_of_students' => $request->number_of_students,
            'passenger_count' => $request->passenger_count,
            'number_of_travelers' => $request->number_of_travelers,
            'accommodation_preference' => $request->accommodation_preference,
            'number_of_seats' => $request->number_of_seats,
            'price' => $request->price,
        ]);
    
        return redirect()->route('booking.userbooking')->with('success', 'Booking created successfully.');
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

          // Send notification to the user
    $booking->user->notify(new BookingStatusNotification($booking, $request->status));

        $booking->update($validated);
        return redirect()->route('booking.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
    
        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('Vendor.Booking.userbooking', compact('bookings'));
    }
    
    
}
