<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\VehicleReservation;
use App\Models\VehicleRelease;

class ReportController extends Controller
{
    public function dailyData()
{
    $startDate = Carbon::now()->subDays(6);
    $endDate = Carbon::now();

    $dates = [];
    $reservationCounts = [];
    $releaseCounts = [];

    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
        $formattedDate = $date->format('Y-m-d');

        // Count reservations
        $reservationCount = VehicleReservation::whereDate('reservation_start_date', $formattedDate)->count();

        // Count ongoing releases (fix case and trim spaces)
        $releaseCount = VehicleRelease::whereDate('release_date', $formattedDate)
            ->whereRaw("LOWER(TRIM(status)) = 'ongoing'")
            ->count();

        // Store data
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
