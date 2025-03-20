<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use App\Models\SupplyReport;
use Illuminate\Http\Request;
use Log;

class SupplyReportController extends Controller
{
    // Display a listing of the audit reports
    public function index()
    {
        // Eager load the 'supply' relationship to access stock details
        $supplyReports = SupplyReport::with('supply')->get();
        return view('Audit.SupplyReport.index', compact('supplyReports'));
    }
    
    
    // Show the form to create a new audit report
    public function create()
    {
        $supplies = Supply::all(); // Get all supplies for the select input
        // $documents = Document::all(); // Get all documents for the select input
        return view('Audit.SupplyReport.create', compact('supplies'));
    }



    public function store(Request $request)
    {
        Log::info('Storing SupplyReport:', $request->all());
    
        $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'document_status' => 'required|in:Pending,Submitted,Approved,Rejected',
            'submitted_at' => 'nullable|date',
        ]);
    
        $report = SupplyReport::create($request->all());
    
        Log::info('SupplyReport Created:', $report->toArray());
    
        return redirect()->route('supplyreport.index')->with('success', 'Audit report created successfully.');
    }
    

    // Display the specified audit report
    public function show(SupplyReport $supplyReport)
    {
        // Eager load supply details
        $supplyReport->load('supply'); 
        return view('Audit.SupplyReport.show', compact('supplyReport'));
    }
    
    // Show the form to edit an existing audit report
    public function edit(SupplyReport $supplyReport)
    {
        $supplies = Supply::all();
        // $documents = Document::all();
        return view('Audit.SupplyReport.edit', compact('supplyReport', 'supplies'));
    }

    // Update the specified audit report in the database
    public function update(Request $request, SupplyReport $supplyReport)

    {
        $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'document_status' => 'required|in:Pending,Submitted,Approved,Rejected',
            'submitted_at' => 'nullable|date',
            'document_id' => 'nullable|exists:documents,id',
        ]);

        $supplyReport->update($request->all());

        return redirect()->route('supplyreport.index')->with('success', 'Audit report updated successfully.');
    }

    // Remove the specified audit report from the database
    public function destroy(SupplyReport $supplyReport)
    {
        $supplyReport->delete();

        return redirect()->route('supplyreport.index')->with('success', 'Audit report deleted successfully.');
    }

}
