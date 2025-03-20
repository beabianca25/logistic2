<?php

namespace App\Http\Controllers;

use App\Models\Booking;


class ReportController extends Controller
{
    public function bookingStatusData()
{
    $bookings = Booking::selectRaw('DATE(created_at) as date, status, COUNT(*) as count')
        ->groupBy('date', 'status')
        ->orderBy('date', 'ASC')
        ->get();

    $dates = $bookings->pluck('date')->unique()->values();

    // Initialize an empty array for status counts
    $statusCounts = [
        'Pending' => [],
        'Approved' => [],
        'Scheduled' => [],
        'Ongoing' => [],
        'Completed' => [],
        'Cancelled' => []
    ];

    // Fill in counts per status per date
    foreach ($dates as $date) {
        foreach ($statusCounts as $status => $values) {
            $count = $bookings->where('date', $date)->where('status', $status)->sum('count');
            $statusCounts[$status][] = $count;
        }
    }

    return response()->json([
        'dates' => $dates,
        'statusCounts' => $statusCounts
    ]);
}

    }
    
