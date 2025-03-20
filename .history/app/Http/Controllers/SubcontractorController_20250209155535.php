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
        $subcontractors = Subcontractor::all();
        return view('Subcontractor.Subcontractor.index', compact('subcontractors'));
    }

    /**
     * Show the form for creating a new subcontractor request.
     */
    public function create()
    {
        return view('Subcontractor.Subcontractor.create');
    }

    /**
     * Store a newly created subcontractor request in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcontractor_name' => 'required|string|max:255',
            'business_registration_number' => 'required|string|unique:subcontractors',
            'contact_person' => 'required|string|max:255',
            'business_address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:subcontractors',
            'website' => 'nullable|url',
            'services_offered' => 'required|string',
            'relevant_experience' => 'required|string',
        ]);
    
        $subcontractor = Subcontractor::create($request->all());
    
        return redirect()->route('requirements.create', ['subcontractor_id' => $subcontractor->id])
                         ->with('success', 'Subcontractor created successfully. Now add requirements.');
    }
    
    /**
     * Display the specified subcontractor request.
     */
    public function show(Subcontractor $id)
    {

           // Fetch the vendor with all related data
           $subcontractor = Subcontractor::with([
            'attachments', 
            'requirments', 
        ])->find($id);
      
        return view('Subcontractor.Subcontractor.show', compact('subcontractor'));
    }

    /**
     * Show the form for editing the specified subcontractor request.
     */
    public function edit(Subcontractor $subcontractor)
    {
        return view('Subcontractor.Subcontractor.edit', compact('subcontractor'));
    }

    /**
     * Update the specified subcontractor request in storage.
     */
    public function update(Request $request, Subcontractor $subcontractor)
    {
        $request->validate([
            'subcontractor_name' => 'required|string|max:255',
            'business_registration_number' => 'required|string|unique:subcontractors,business_registration_number,' . $subcontractor->id,
            'contact_person' => 'required|string|max:255',
            'business_address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:subcontractors,email,' . $subcontractor->id,
            'website' => 'nullable|url',
            'services_offered' => 'required|string',
            'relevant_experience' => 'required|string',
        ]);

        $subcontractor->update($request->all());

        return redirect()->route('requirements.create', ['subcontractor_id' => $subcontractor->id])
                         ->with('success', 'Subcontractor updated successfully. Now add requirements.');
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
