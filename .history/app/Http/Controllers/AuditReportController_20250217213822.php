<?php

namespace App\Http\Controllers;

use App\Models\AuditReport;
use Illuminate\Http\Request;

class AuditReportController extends Controller
{
    /**
     * Display a listing of the audit reports.
     */
    public function index()
    {
        $auditReports = AuditReport::all();
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
        $request->validate([
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'location' => 'nullable|string|max:255',
            'report_date' => 'required|date',
            'auditable_type' => 'required|string',
            'auditable_id' => 'required|integer',
        ]);

        AuditReport::create($request->all());

        return redirect()->route('report.index')->with('success', 'Audit report created successfully.');
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
    public function update(Request $request, AuditReport $auditReport)
    {
        $request->validate([
            'report_title' => 'required|string|max:255',
            'report_details' => 'required|string',
            'status' => 'required|in:Pending Review,Reviewed,Resolved',
            'location' => 'nullable|string|max:255',
            'report_date' => 'required|date',
        ]);

        $auditReport->update($request->all());

        return redirect()->route('report.index')->with('success', 'Audit report updated successfully.');
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
