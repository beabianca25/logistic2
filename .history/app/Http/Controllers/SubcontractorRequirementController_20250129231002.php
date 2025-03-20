<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('Subcontractor.Requirements.index', compact('requirements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($subcontractor_id)
    {
        $subcontractor = Subcontractor::findOrFail($subcontractor_id); // Retrieve the subcontractor by id
        return view('Subcontractor.Requirements.create', compact('subcontractor_id')); // Pass subcontractor_id to the view
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcontractor_id' => 'required|exists:subcontractors,id', // ✅ Ensure subcontractor exists
            'estimated_cost' => 'required|numeric|min:0',
            'preferred_payment_terms' => 'nullable|string|max:255',
            'start_date_availability' => 'required|date',
            'estimated_completion_time' => 'required|string|max:255',
            'resources_required' => 'nullable|string',
            'insurance_coverage' => 'required|string|max:255',
            'certifications_or_licenses' => 'nullable|string',
        ]);
    
        SubcontractorRequirement::create($request->all());
    
        return redirect()->route('requirements.index')
                         ->with('success', 'Subcontractor requirement created successfully.');
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
        $request->validate([
            'estimated_cost' => 'required|numeric|min:0',
            'preferred_payment_terms' => 'nullable|string|max:255',
            'start_date_availability' => 'required|date',
            'estimated_completion_time' => 'required|string|max:255',
            'resources_required' => 'nullable|string',
            'insurance_coverage' => 'required|string|max:255',
            'certifications_or_licenses' => 'nullable|string',
        ]);

        $subcontractorRequirement->update($request->all());

        return redirect()->route('subcontractor.index')
                         ->with('success', 'Subcontractor requirement updated successfully.');
    }

    /**
     * Remove the specified subcontractor requirement from storage.
     */
    public function destroy(SubcontractorRequirement $subcontractorRequirement)
    {
        $subcontractorRequirement->delete();

        return redirect()->route('subcontractor.index')
                         ->with('success', 'Subcontractor requirement deleted successfully.');
    }
}
