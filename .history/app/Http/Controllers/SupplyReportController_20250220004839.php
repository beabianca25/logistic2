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
        return view('Audit.SupplyReport.index', compact('supplyReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Get all supplies for the dropdown
         $supplies = Supply::all();

         return view('Audit.SupplyReport.create', compact('supplies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input (removed 'report_title' since it's defaulted in the migration)
        $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'status' => 'required|in:Pending,Approved,Rejected',
            'location' => 'nullable|string',
            'report_date' => 'required|date',
        ]);
    
        // Create new supply report (no need to include 'report_title')
        SupplyReport::create([
            'supply_id' => $request->supply_id,
            'description' => $request->description, // optional field
            'status' => $request->status,
            'location' => $request->location,
            'report_date' => $request->report_date,
        ]);
    
        return redirect()->route('supplyreport.index')->with('success', 'Supply Report created successfully!');
    }
    
        //

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('Audit.SupplyReport.show', compact('supplyReport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $report = SupplyReport::find($id);
    
        if (!$report) {
            return redirect()->route('supplyreport.index')->with('error', 'Report not found.');
        }
    
        return view('Audit.SupplyReport.edit', compact('report'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplyReport $supplyReport)
    {
        // Validate input
        $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'report_title' => 'required|string',
            'status' => 'required|in:Pending,Approved,Rejected',
            'location' => 'nullable|string',
            'report_date' => 'required|date',
        ]);

        // Update the supply report
        $supplyReport->update([
            'supply_id' => $request->supply_id,
            'report_title' => $request->report_title,
            'description' => $request->description, // optional field
            'status' => $request->status,
            'location' => $request->location,
            'report_date' => $request->report_date,
        ]);

        // Redirect to the supply reports index with success message
        return redirect()->route('supplyreport.index')->with('success', 'Supply Report updated successfully!');
    }

 
    public function destroy(SupplyReport $supplyReport)
    {
        // Delete the supply report
        $supplyReport->delete();

        // Redirect to the supply reports index with success message
        return redirect()->route('supplyreport.index')->with('success', 'Supply Report deleted successfully!');
    }

}
