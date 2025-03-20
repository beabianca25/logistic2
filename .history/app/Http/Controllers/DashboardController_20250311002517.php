<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bid; // Import the Bid model

class DashboardController extends Controller
{

    public function index()
    {
        $bids = Bid::with(['user']) // Load user relationship
        ->orderBy('created_at', 'desc')
        ->take(5) // Fetch latest 5 bids
        ->get();

        $users = User::latest()->take(8)->get(); // Get the latest 8 users
        return view('dashboard', compact('users', 'bids'));
    }
    

}
