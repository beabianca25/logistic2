<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VehicleLocation;
use Illuminate\Http\Request;

class VehicleLocationController extends Controller
{
    public function storeLocation(Request $request, $vehicleId)
{
    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    VehicleLocation::create([
        'vehicle_id' => $vehicleId,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'recorded_at' => now(),
    ]);

    return response()->json(['message' => 'Location updated successfully']);
}
}
