<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Fetch all bookings
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $approvedBookings = Booking::where('status', 'Approved')->count();
        $cancelledBookings = Booking::where('status', 'Cancelled')->count();
        
        // Fetch all bookings data
        $bookings = Booking::with('user')->get(); // Assuming you have a relationship with User
    
        return view('userdashboard', compact('totalBookings', 'pendingBookings', 'approvedBookings', 'cancelledBookings', 'bookings'));
    }
    

}
