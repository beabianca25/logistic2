<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bid;

class DashboardController extends Controller
{
    public function index()
    {
        $bids = Bid::with(['user', 'auction'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $users = User::latest()->take(8)->get();
        $bidCount = Bid::count();

        // Count vendor, supplier, and subcontractor applications
        $vendorCount = Vendor::count();
        $supplierCount = Supplier::count();
        $subcontractorCount = Subcontractor::count();

        return view('dashboard', compact('users', 'bids', 'bidCount', 'vendorCount', 'supplierCount', 'subcontractorCount'));
    }

    // New function to return application counts as JSON
    public function getApplicationsCount()
    {
        return response()->json([
            'vendors' => Vendor::count(), 
            'suppliers' => Supplier::count(),
            'subcontractors' => Subcontractor::count()
        ]);
    }
}
