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
        $reports = AssetReport::orderBy('created_at', 'desc')->paginate(10);
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
        $assetReport = AssetReport::findOrFail($id);
        $assets = Asset::all();
        return view('Audit.AssetReport.edit', compact('assetReport', 'assets'));
    }

    // Update an asset report
    public function update(Request $request, AssetReport $assetReport)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'report_type' => 'required|in:Maintenance,Warranty Expiry,Disposal',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'report_date' => 'nullable|date',
        ]);

        $assetReport->update($request->all());

        return redirect()->route('assetreport.index')->with('success', 'Asset report updated successfully.');
    }

    // Delete an asset report
    public function destroy(AssetReport $assetReport)
    {
        $assetReport->delete();
        return redirect()->route('assetreport.index')->with('success', 'Asset report deleted successfully.');
    }
}
