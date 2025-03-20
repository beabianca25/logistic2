<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use App\Models\SupplyReport;
use Illuminate\Http\Request;

class SupplyReportController extends Controller
{
    // Display a listing of the audit reports
    public function index()
    {
        $supplyReports = SupplyReport::with('supply')->get();
    
        // Count reports by status
        $pendingCount = SupplyReport::where('status', 'Pending Review')->count();
        $reviewedCount = SupplyReport::where('status', 'Reviewed')->count();
        $approvedCount = SupplyReport::where('status', 'Approved')->count();
        $otherCount = SupplyReport::whereNotIn('status', ['Pending Review', 'Reviewed', 'Approved'])->count();
    
        return view('Audit.SupplyReport.index', compact('supplyReports', 'pendingCount', 'reviewedCount', 'approvedCount', 'otherCount'));
    }
    
    
    
    
    
    // Show the form to create a new audit report
    public function create()
    {
        $supplies = Supply::all(); // Get all supplies for the select input
        // $documents = Document::all(); // Get all documents for the select input
        return view('Audit.SupplyReport.create', compact('supplies'));
    }

    // Store a newly created audit report in the database
    public function store(Request $request)
    {
        $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'document_status' => 'required|in:Pending,Submitted,Approved,Rejected',
            'submitted_at' => 'nullable|date',
        ]);

        SupplyReport::create($request->all());

        return redirect()->route('supplyreport.index')->with('success', 'Audit report created successfully.');
    }

    // Display the specified audit report
    public function show($id)
    {
        $supplyReport = SupplyReport::find($id); // Ensure it's a single record
    
        if (!$supplyReport) {
            abort(404, 'Supply Report not found.');
        }
    
        return view('Audit.SupplyReport.show', compact('supplyReport'));
    }
    
    
    // Show the form to edit an existing audit report
    public function edit($id)
    {
        $supplyReport = SupplyReport::findOrFail($id); // Ensure it exists
        $supplies = Supply::all(); // Load supplies if needed
    
        return view('Audit.SupplyReport.edit', compact('supplyReport', 'supplies'));
    }
    
    

    // Update the specified audit report in the database
    public function update(Request $request, $id)
    {
        // Debug: Check if request is received
        \Log::info('Update Request Data:', $request->all());
    
        // Find the record
        $supplyReport = SupplyReport::findOrFail($id);
    
        $validatedData = $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'document_status' => 'required|in:Pending,Submitted,Approved,Rejected',
            'submitted_at' => 'nullable|date',
        ]);
    
        // Debug: Check if update was executed
        if ($supplyReport->update($validatedData)) {
            \Log::info('Update Successful');
        } else {
            \Log::error('Update Failed');
        }
    
        return redirect()->route('supplyreport.index')->with('success', 'Audit report updated successfully.');
    }
    
    // Remove the specified audit report from the database
    public function destroy(SupplyReport $supplyReport)
    {
        $supplyReport->delete();

        return redirect()->route('supplyreport.index')->with('success', 'Audit report deleted successfully.');
    }

}
