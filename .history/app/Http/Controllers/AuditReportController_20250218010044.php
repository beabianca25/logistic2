<?php

namespace App\Http\Controllers;

use App\Models\AuditReport;
use App\Models\Supply;
use Illuminate\Http\Request;

class AuditReportController extends Controller
{
    /**
     * Display a listing of the audit reports.
     */
    public function index()
    {
        $auditReports = AuditReport::paginate(10);  
        return view('Audit.Report.index', compact('auditReports'));
    }

    /**
     * Show the form for creating a new audit report.
     */
    public function create()
    {
        return view('Audit.Report.create');
    }

    /**
     * Store a newly created audit report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'nullable|exists:assets,id',
            'supply_id' => 'nullable|exists:supplies,id',
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'location' => 'nullable|string',
            'report_date' => 'nullable|date',
        ]);

        // Ensure that either asset_id or supply_id is present
        if (!$validated['asset_id'] && !$validated['supply_id']) {
            return back()->withErrors(['error' => 'You must provide either an Asset or a Supply.']);
        }

        $auditReport = AuditReport::create($validated);

        return redirect()->route('audit.index')->with('success', 'Audit report created successfully.');
    }
    

    /**
     * Display the specified audit report.
     */
    public function show(AuditReport $auditReport)
    {
        return view('Audit.Report.show', compact('auditReport'));
    }

    /**
     * Show the form for editing the specified audit report.
     */
    public function edit(AuditReport $auditReport)
    {
        return view('Audit.Report.edit', compact('auditReport'));
    }

    /**
     * Update the specified audit report in storage.
     */
    public function update(Request $request, Supply $supply)
    {
        // Validate only the remaining stock field
        $validated = $request->validate([
            'remaining_stock' => 'required|integer|min:0',  // Only validate remaining stock
        ]);
    
        // Calculate the change in stock
        $quantityChanged = $request->remaining_stock - $supply->remaining_stock;
    
        // Update only the remaining stock
        $supply->remaining_stock = $request->remaining_stock;
        $supply->save();
    
        // Create an audit report for the stock change
        AuditReport::create([
            'report_title' => 'Supply Stock Updated', // Add report title
            'report_details' => 'Supply: ' . $supply->supply_name . ' updated. Remaining stock: ' . $request->remaining_stock,
            'status' => 'Pending Review', // Add status
            'location' => $supply->storage_location, // Use the storage location
            'report_date' => now(), // Use current timestamp
        ]);
    
        return redirect()->route('supply.index')->with('success', 'Remaining stock updated successfully.');
    }
    
    /**
     * Remove the specified audit report from storage.
     */
    public function destroy(AuditReport $auditReport)
    {
        $auditReport->delete();
        return redirect()->route('report.index')->with('success', 'Audit report deleted successfully.');
    }
}
