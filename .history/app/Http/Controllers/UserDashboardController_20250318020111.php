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
        // Get the authenticated user
        $user = Auth::user();

        // Fetch user-specific bookings
        $totalBookings = Booking::where('user_id', $user->id)->count();
        $pendingBookings = Booking::where('user_id', $user->id)->where('status', 'Pending')->count();
        $approvedBookings = Booking::where('user_id', $user->id)->where('status', 'Approved')->count();
        $cancelledBookings = Booking::where('user_id', $user->id)->where('status', 'Cancelled')->count();

        return view('userdashboard', compact('user', 'totalBookings', 'pendingBookings', 'approvedBookings', 'cancelledBookings'));
    }}
