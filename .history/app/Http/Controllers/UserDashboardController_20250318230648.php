<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bid;
use App\Models\Vehicle;
use App\Models\Document;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Fetch booking statistics
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $approvedBookings = Booking::where('status', 'Approved')->count();
        $cancelledBookings = Booking::where('status', 'Cancelled')->count();

        // Fetch all bookings data
        $bookings = Booking::with('user')->get();

        // Fetch additional statistics
        $reservationCount = Booking::where('status', 'Approved')->count();
        $bidCount = Bid::count();
        $activeVehicleCount = Vehicle::where('current_status', 'Active')->count();
        $pendingDocumentCount = Document::where('status', 'Pending')->count();

         // Count ongoing vehicle releases
    $ongoingReleases = \App\Models\VehicleRelease::where('status', 'Ongoing')->count();

        return view('userdashboard', compact(
            'totalBookings', 'pendingBookings', 'approvedBookings', 'cancelledBookings', 
            'bookings', 'reservationCount', 'bidCount', 'activeVehicleCount', 'pendingDocumentCount', 'ongoingReleases'
        ));
    }

    // AJAX function to get reservation count
    public function getReservationCount()
    {
        $count = Booking::where('status', 'Approved')->count();
        return response()->json(['count' => $count]);
    }

    // AJAX function to get bid count
    public function getBidCount()
    {
        $bidCount = Bid::count();
        return response()->json(['bidCount' => $bidCount]);
    }

    // AJAX function to get active vehicle count
    public function getActiveVehicleCount()
    {
        $activeVehicleCount = Vehicle::where('current_status', 'Active')->count();
        return response()->json(['activeVehicleCount' => $activeVehicleCount]);
    }

    // AJAX function to get pending document count
    public function getPendingDocumentCount()
    {
        $pendingDocumentCount = Document::where('status', 'Pending')->count();
        return response()->json(['pendingDocumentCount' => $pendingDocumentCount]);
    }
}
