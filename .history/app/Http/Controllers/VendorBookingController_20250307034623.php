<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorBookingController extends Controller
{
    /**
     * Display a listing of vendor bookings.
     */
    public function index()
    {
       
        $bookings = VendorBooking::with('vendor', 'user')->latest()->get();
        return view('Vendor.Booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new vendor booking.
     */
    public function create()
    {
        $vendors = \App\Models\Vendor::all(); // Fetch all vendors
        return view('Vendor.Booking.create', compact('vendors'));
    }
    
    /**
     * Store a newly created vendor booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'booking_type' => 'required|string',
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'booking_date' => 'required|date',
            'status' => 'in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled'
        ]);

        VendorBooking::create([
            'vendor_id' => $request->vendor_id,
            'user_id' => Auth::id(),
            'booking_type' => $request->booking_type,
            'pickup_location' => $request->pickup_location,
            'dropoff_location' => $request->dropoff_location,
            'notes' => $request->notes,
            'booking_date' => $request->booking_date,
            'status' => 'Pending'
        ]);

        return redirect()->route('booking.index')->with('success', 'Vendor booking created successfully.');
    }

    /**
     * Display the specified vendor booking.
     */
    public function show($id)
    {
        $vendorBooking = VendorBooking::with('vendor')->find($id);
        
        if (!$vendorBooking) {
            abort(404, 'Booking not found');
        }
    
        return view('Vendor.Booking.show', compact('vendorBooking'));
    }
    
    /**
     * Show the form for editing the specified vendor booking.
     */
    public function edit($id)
    {
        $vendorBooking = VendorBooking::find($id);
    
        if (!$vendorBooking) {
            return redirect()->route('booking.index')->with('error', 'Booking not found.');
        }
    
        $vendors = Vendor::all();
    
        return view('Vendor.Booking.edit', compact('vendorBooking', 'vendors'));
    }
    
    
    /**
     * Update the specified vendor booking in storage.
     */
    public function update(Request $request, VendorBooking $vendorBooking)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'booking_type' => 'required|string',
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'booking_date' => 'required|date',
            'status' => 'in:Pending,Approved,Scheduled,Ongoing,Completed,Cancelled'
        ]);

        $vendorBooking->update($request->all());

        return redirect()->route('booking.index')->with('success', 'Vendor booking updated successfully.');
    }

    /**
     * Remove the specified vendor booking from storage.
     */
    public function destroy(VendorBooking $vendorBooking)
    {
        $vendorBooking->delete();
        return redirect()->route('booking.index')->with('success', 'Vendor booking deleted successfully.');
    }
}
