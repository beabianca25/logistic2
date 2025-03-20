<?php

namespace App\Http\Controllers;

use App\Models\Booking;


class ReportController extends Controller
{
    public function bookingStatusData()
    {
        $bookings = Booking::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, status, COUNT(*) as count')
            ->groupBy('month', 'status')
            ->orderBy('month', 'ASC')
            ->get();
    
        $months = $bookings->pluck('month')->unique()->values();
    
        // Define all possible statuses
        $allStatuses = ['Pending', 'Approved', 'Scheduled', 'Ongoing', 'Completed', 'Cancelled'];
    
        // Initialize an empty array with default values (0 counts for each status)
        $statusCounts = [];
        foreach ($allStatuses as $status) {
            $statusCounts[$status] = array_fill(0, count($months), 0);
        }
    
        // Fill actual counts from database
        foreach ($bookings as $booking) {
            $monthIndex = $months->search($booking->month); // Find the index of the month
            $statusCounts[$booking->status][$monthIndex] = $booking->count;
        }
    
        return response()->json([
            'months' => $months,
            'statusCounts' => $statusCounts
        ]);
    }
    
}

    
