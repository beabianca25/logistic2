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
    
        // Get unique months from the booking data
        $months = $bookings->pluck('month')->unique()->values();
    
        // Define all possible statuses
        $allStatuses = ['Pending', 'Approved', 'Scheduled', 'Ongoing', 'Completed', 'Cancelled'];
    
        // Get all months in the current year (optional: modify to fit your needs)
        $allMonths = collect();
        for ($i = 1; $i <= 12; $i++) {
            $allMonths->push(date('Y-') . str_pad($i, 2, '0', STR_PAD_LEFT)); // e.g., "2025-01", "2025-02", etc.
        }
    
        // Ensure all months are included in the final dataset
        $months = $allMonths->merge($months)->unique()->values()->sort();
    
        // Initialize an empty array with default values (0 counts for each status)
        $statusCounts = [];
        foreach ($allStatuses as $status) {
            $statusCounts[$status] = array_fill(0, count($months), 0);
        }
    
        // Fill actual counts from database
        foreach ($bookings as $booking) {
            $monthIndex = $months->search($booking->month); // Find the index of the month
            if ($monthIndex !== false) {
                $statusCounts[$booking->status][$monthIndex] = $booking->count;
            }
        }
    
        return response()->json([
            'months' => $months,
            'statusCounts' => $statusCounts
        ]);
    }
}    
    
