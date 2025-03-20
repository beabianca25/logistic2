<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use App\Models\SubcontractorRequirement;
use Illuminate\Http\Request;

class SubcontractorRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requirements = SubcontractorRequirement::all();
        $subcontractors = Subcontractor::all();
        return view('Subcontractor.Requirements.index', compact('requirements', 'subcontractors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($subcontractor_id)
    {
        $subcontractor = Subcontractor::findOrFail($subcontractor_id); // Retrieve the subcontractor by id
        return view('Subcontractor.Requirements.create', compact('subcontractor')); // Pass subcontractor_id to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'subcontractor_id' => 'required|exists:subcontractors,id', // Ensure subcontractor exists
            'estimated_cost' => 'required|numeric|min:0',
            'preferred_payment_terms' => 'nullable|string|max:255',
            'start_date_availability' => 'required|date',
            'estimated_completion_time' => 'required|string|max:255',
            'resources_required' => 'nullable|string',
            'insurance_coverage' => 'required|string|max:255',
            'certifications_or_licenses' => 'nullable|string',
        ]);
    
        // Create a new subcontractor requirement entry using $request->only() to avoid repetition
        SubcontractorRequirement::create($request->only([
            'subcontractor_id', 
            'estimated_cost', 
            'preferred_payment_terms', 
            'start_date_availability', 
            'estimated_completion_time', 
            'resources_required', 
            'insurance_coverage', 
            'certifications_or_licenses'
        ]));
    
        // Redirect to the attachments.create route with the subcontractor_id
        return redirect()->route('attachments.create', ['subcontractor_id' => $request->subcontractor_id]);
    }

    /**
     * Display the specified subcontractor requirement.
     */
    public function show(SubcontractorRequirement $subcontractorRequirement)
    {
        return view('Subcontractor.Requirements.show', compact('subcontractorRequirement'));
    }

    /**
     * Show the form for editing the specified subcontractor requirement.
     */
    public function edit(SubcontractorRequirement $subcontractorRequirement)
    {
        return view('Subcontractor.Requirements.edit', compact('subcontractorRequirement'));
    }

    /**
     * Update the specified subcontractor requirement in storage.
     */
    public function update(Request $request, SubcontractorRequirement $subcontractorRequirement)
    {
        // Validate the incoming data for update
        $request->validate([
            'estimated_cost' => 'required|numeric|min:0',
            'preferred_payment_terms' => 'nullable|string|max:255',
            'start_date_availability' => 'required|date',
            'estimated_completion_time' => 'required|string|max:255',
            'resources_required' => 'nullable|string',
            'insurance_coverage' => 'required|string|max:255',
            'certifications_or_licenses' => 'nullable|string',
        ]);

        // Update the subcontractor requirement with validated data
        $subcontractorRequirement->update($request->only([
            'estimated_cost', 
            'preferred_payment_terms', 
            'start_date_availability', 
            'estimated_completion_time', 
            'resources_required', 
            'insurance_coverage', 
            'certifications_or_licenses'
        ]));

        // Redirect with a success message
        return redirect()->route('subcontractor.index')
                         ->with('success', 'Subcontractor requirement updated successfully.');
    }

    /**
     * Remove the specified subcontractor requirement from storage.
     */
    public function destroy(SubcontractorRequirement $subcontractorRequirement)
    {
        // Delete the subcontractor requirement
        $subcontractorRequirement->delete();

        // Redirect with a success message
        return redirect()->route('subcontractor.index')
                         ->with('success', 'Subcontractor requirement deleted successfully.');
    }
}
