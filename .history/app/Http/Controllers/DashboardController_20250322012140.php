<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subcontractor;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bid; // Import the Bid model

class DashboardController extends Controller
{

    public function index()
    {
        $bids = Bid::with(['user', 'auction']) // Load user & auction data
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $users = User::latest()->take(8)->get(); // Get latest 8 users

        $bidCount = Bid::count(); // Count total bids

        // Count vendor, supplier, and subcontractor applications
        $vendorCount = Vendor::count();
        $supplierCount = Supplier::count();
        $subcontractorCount = Subcontractor::count();

        return view('dashboard', compact('users', 'bids', 'bidCount', 'vendorCount', 'supplierCount', 'subcontractorCount'));
    }
    

}
