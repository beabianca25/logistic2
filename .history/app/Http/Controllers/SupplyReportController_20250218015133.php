<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use App\Models\SupplyReport;
use Illuminate\Http\Request;

class SupplyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all supply reports
        $supplyReports = SupplyReport::all();

        // Return view with supply reports
        return view('supply_reports.index', compact('supplyReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Get all supplies for the dropdown
         $supplies = Supply::all();

         return view('supply_reports.create', compact('supplies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'report_title' => 'required|string',
            'status' => 'required|in:Pending,Approved,Rejected',
            'location' => 'nullable|string',
            'report_date' => 'required|date',
        ]);

         // Create new supply report
         SupplyReport::create([
            'supply_id' => $request->supply_id,
            'report_title' => $request->report_title,
            'description' => $request->description, // optional field
            'status' => $request->status,
            'location' => $request->location,
            'report_date' => $request->report_date,
        ]);

        // Redirect back to the supply reports index with success message
        return redirect()->route('supply_reports.index')->with('success', 'Supply Report created successfully!');
    }
        //

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
