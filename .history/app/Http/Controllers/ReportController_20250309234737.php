<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\VehicleReservation;
use App\Models\VehicleRelease;
use Log;

class ReportController extends Controller
{
    public function dailyData()
    {
        $startDate = Carbon::now()->subDays(6); // Last 7 days
        $endDate = Carbon::now();
    
        $dates = [];
        $reservationCounts = [];
        $releaseCounts = [];
    
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
    
            $reservationCount = VehicleReservation::whereDate('reservation_start_date', $formattedDate)->count();
            $releaseCount = VehicleRelease::whereDate('release_date', $formattedDate)
                ->where('status', 'Ongoing')
                ->count();
    
            // Debugging output
            Log::info("Date: $formattedDate, Reservations: $reservationCount, Releases: $releaseCount");
    
            $dates[] = $formattedDate;
            $reservationCounts[] = $reservationCount;
            $releaseCounts[] = $releaseCount;
        }
    
        return response()->json([
            'dates' => $dates,
            'reservationCounts' => $reservationCounts,
            'releaseCounts' => $releaseCounts
        ]);
    }

}
