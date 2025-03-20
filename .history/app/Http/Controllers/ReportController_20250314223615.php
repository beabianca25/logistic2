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

    // Initialize an empty array for status counts
    $statusCounts = [
        'Pending' => [],
        'Approved' => [],
        'Scheduled' => [],
        'Ongoing' => [],
        'Completed' => [],
        'Cancelled' => []
    ];

    // Fill in counts per status per month
    foreach ($months as $month) {
        foreach ($statusCounts as $status => $values) {
            $count = $bookings->where('month', $month)->where('status', $status)->sum('count');
            $statusCounts[$status][] = $count;
        }
    }

    return response()->json([
        'months' => $months,
        'statusCounts' => $statusCounts
    ]);
}

}

    
