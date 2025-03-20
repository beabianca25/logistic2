<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use App\Models\SubcontractorAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcontractorAttachmentController extends Controller
{
    /**
     * Display a listing of subcontractor attachments.
     */
    public function index()
    {
        $attachments = SubcontractorAttachment::all();
        $subcontractors = Subcontractor
        return view('Subcontractor.Attachments.index', compact('attachments', 'subcontractors'));
    }

    /**
     * Show the form for creating a new subcontractor attachment.
     */
    public function create($subcontractor_id)
    {
        $subcontractor = Subcontractor::findOrFail($subcontractor_id); // Find subcontractor by id
        return view('Subcontractor.Attachments.create', compact('subcontractor')); // Pass to view
    }
    

    /**
     * Store a newly created subcontractor attachment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcontractor_id' => 'required|exists:subcontractors,id',
            'portfolio_samples' => 'required|file|mimes:jpg,jpeg,png,pdf', // Example file validation
            'business_licenses' => 'required|file|mimes:jpg,jpeg,png,pdf', // Example file validation
            'signature' => 'required|file|mimes:jpg,jpeg,png,pdf', // Example file validation
            // Add more validation if needed
        ]);
    
        // Store the attachments and related data
        SubcontractorAttachment::create([
            'subcontractor_id' => $request->subcontractor_id,
            'portfolio_samples' => $request->file('portfolio_samples')->store('attachments'),
            'business_licenses' => $request->file('business_licenses')->store('attachments'),
            'signature' => $request->file('signature')->store('attachments'),
            'agreement_acknowledged' => $request->agreement_acknowledged,
            'submission_date' => $request->submission_date,
        ]);
    
        return redirect()->route('login')->with('success', 'Attachment uploaded successfully!');

    }
    
    /**
     * Display the specified subcontractor attachment.
     */
    public function show($id)
    {
        $attachment = SubcontractorAttachment::findOrFail($id);
        return view('Subcontractor.Attachments.show', compact('attachment'));
    }

    /**
     * Show the form for editing the specified subcontractor attachment.
     */
    public function edit($id)
    {
        $attachment = SubcontractorAttachment::findOrFail($id);
        return view('Subcontractor.Attachments.edit', compact('attachment'));
    }

    /**
     * Update the specified subcontractor attachment in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'portfolio_samples' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'business_licenses' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'agreement_acknowledged' => 'required|boolean',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png',
            'submission_date' => 'required|date',
        ]);

        $attachment = SubcontractorAttachment::findOrFail($id);

        // Update files if provided
        if ($request->hasFile('portfolio_samples')) {
            Storage::delete($attachment->portfolio_samples); // Delete the old file
            $attachment->portfolio_samples = $request->file('portfolio_samples')->store('subcontractor_attachments');
        }
        if ($request->hasFile('business_licenses')) {
            Storage::delete($attachment->business_licenses); // Delete the old file
            $attachment->business_licenses = $request->file('business_licenses')->store('subcontractor_attachments');
        }
        if ($request->hasFile('signature')) {
            Storage::delete($attachment->signature); // Delete the old file
            $attachment->signature = $request->file('signature')->store('subcontractor_attachments');
        }

        // Update the other fields
        $attachment->agreement_acknowledged = $request->agreement_acknowledged;
        $attachment->submission_date = $request->submission_date;

        $attachment->save();

        return redirect()->route('attachments.index')
                         ->with('success', 'Attachment updated successfully.');
    }

    /**
     * Remove the specified subcontractor attachment from storage.
     */
    public function destroy($id)
    {
        $attachment = SubcontractorAttachment::findOrFail($id);

        // Delete files from storage
        Storage::delete($attachment->portfolio_samples);
        Storage::delete($attachment->business_licenses);
        Storage::delete($attachment->signature);

        // Delete the record from the database
        $attachment->delete();

        return redirect()->route('attachments.index')
                         ->with('success', 'Attachment deleted successfully.');
    }
}
