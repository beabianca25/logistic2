<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetReport;
use Illuminate\Http\Request;

class AssetReportController extends Controller
{
    // Display all asset reports
    public function index()
    {
        $assetReports = AssetReport::with('asset')->latest()->get();
        return view('Audit.AssetReport.index', compact('assetReports'));
    }

    // Show form to create an asset report
    public function create()
    {
        $assets = Asset::all();
        return view('Audit.AssetReport.create', compact('assets'));
    }

    // Store a newly created asset report
    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'report_type' => 'required|in:Maintenance,Warranty Expiry,Disposal',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'report_date' => 'nullable|date',
        ]);

        AssetReport::create($request->all());

        return redirect()->route('assetreport.index')->with('success', 'Asset report created successfully.');
    }

    // Display a specific report
    public function show($id)
    {
        $assetReport = AssetReport::findOrFail($id);
        return view('Audit.AssetReport.show', compact('assetReport'));
    }

    // Show the form for editing a report
    public function edit($id)
    {
        $report = AssetReport::findOrFail($id); // Find the report by ID
        $assets = Asset::all(); // Fetch all assets for dropdown
    
        return view('Audit.AssetReport.edit', compact('report', 'assets'));
    }
    

    // Update an asset report
    public function update(Request $request, $id)
{
    $request->validate([
        'asset_id' => 'required|exists:assets,id',
        'report_title' => 'required|string|max:255',
        'report_details' => 'required|string',
        'report_type' => 'required|in:Maintenance,Warranty Expiry,Disposal',
        'status' => 'required|in:Pending Review,Reviewed,Resolved',
        'report_date' => 'nullable|date',
    ]);

    // Find the report by ID
    $report = AssetReport::findOrFail($id);
    $report->update([
        'asset_id' => $request->asset_id,
        'report_title' => $request->report_title,
        'report_details' => $request->report_details,
        'report_type' => $request->report_type,
        'status' => $request->status, // Make sure status is updated
        'report_date' => $request->report_date,
    ]);

    return redirect()->route('assetreport.index')->with('success', 'Asset report updated successfully.');
}


    // Delete an asset report
    public function destroy($id)
    {
        $assetReport = AssetReport::findOrFail($id);
        $assetReport->delete();
    
        return redirect()->route('assetreport.index')->with('success', 'Asset report deleted successfully.');
    }
    
}
