<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use Illuminate\Http\Request;

class SubcontractorController extends Controller
{
    /**
     * Display a listing of the subcontractor requests.
     */
    public function index()
    {
        $requests = Subcontractor::all();
        return view('vendor.subcontractor.index', compact('requests'));
    }

    /**
     * Show the form for creating a new subcontractor request.
     */
    public function create()
    {
        return view('vendor.subcontractor.create');
    }

    /**
     * Store a newly created subcontractor request in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcontractor_name' => 'required|string|max:255',
            'project_scope' => 'required|string',
            'cost_estimate' => 'required|numeric',
            'timeline' => 'required|string',
            'contact_information' => 'required|string',
            'submitted_date' => 'required|date',
            'status' => 'in:Pending,Admin_Review,Buyer_Approved,Manager_Approved',
        ]);

        Subcontractor::create($request->all());

        return redirect()->route('subcontractor.index')->with('success', 'Subcontractor request created successfully.');
    }

    /**
     * Display the specified subcontractor request.
     */
    public function show(Subcontractor $subcontractor)
    {
        return view('vendor.subcontractor.show', compact('subcontractor'));
    }

    /**
     * Show the form for editing the specified subcontractor request.
     */
    public function edit(Subcontractor $subcontractor)
    {
        return view('vendor.subcontractor.edit', compact('subcontractor'));
    }

    /**
     * Update the specified subcontractor request in storage.
     */
    public function update(Request $request, Subcontractor $subcontractor)
    {
        $request->validate([
            'subcontractor_name' => 'required|string|max:255',
            'project_scope' => 'required|string',
            'cost_estimate' => 'required|numeric',
            'timeline' => 'required|string',
            'contact_information' => 'required|string',
            'submitted_date' => 'required|date',
            'status' => 'in:Pending,Admin_Review,Buyer_Approved,Manager_Approved',
        ]);

        $subcontractor->update($request->all());

        return redirect()->route('subcontractor.index')->with('success', 'Subcontractor request updated successfully.');
    }

    /**
     * Remove the specified subcontractor request from storage.
     */
    public function destroy(Subcontractor $subcontractor)
    {
        $subcontractor->delete();

        return redirect()->route('subcontractor.index')->with('success', 'Subcontractor request deleted successfully.');
    }
}
