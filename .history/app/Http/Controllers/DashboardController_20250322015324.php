<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;

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
        $applications = DB::table('vendors') // Replace 'vendors' with the actual table
            ->select(DB::raw('DATE(created_at) as date'), 
                     DB::raw('SUM(CASE WHEN business_type = "Vendor" THEN 1 ELSE 0 END) as vendors'),
                     DB::raw('SUM(CASE WHEN business_type = "Supplier" THEN 1 ELSE 0 END) as suppliers'),
                     DB::raw('SUM(CASE WHEN business_type = "Subcontractor" THEN 1 ELSE 0 END) as subcontractors'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    
        return response()->json([
            'dates' => $applications->pluck('date'),
            'vendors' => $applications->pluck('vendors'),
            'suppliers' => $applications->pluck('suppliers'),
            'subcontractors' => $applications->pluck('subcontractors'),
        ]);
    }
}
