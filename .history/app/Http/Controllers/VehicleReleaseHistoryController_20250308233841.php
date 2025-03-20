<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VehicleReleaseHistory;
use Illuminate\Http\Request;

class VehicleReleaseHistoryController extends Controller
{
    public function index()
    {
        $histories = VehicleReleaseHistory::all();
        return view('Reservation.History.index', compact('histories'));
    }
}
