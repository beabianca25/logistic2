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
        return view('Subcontractor.Attachments.index', compact('attachments'));
    }

    /**
     * Show the form for creating a new subcontractor attachment.
     */
    public function create()
    {
        $subcontractors = Subcontractor::all(); // Fetch all subcontractors
        return view('subcontractor_attachments.create', compact('subcontractors')); // Pass to view
    }
    

    /**
     * Store a newly created subcontractor attachment in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'subcontractor_id' => 'required|exists:subcontractors,id', // Ensure subcontractor exists
            'portfolio_samples' => 'required|file|mimes:jpg,png,pdf|max:10240', // 10MB max
            'business_licenses' => 'required|file|mimes:jpg,png,pdf|max:10240',
            'agreement_acknowledged' => 'required|accepted',
            'signature' => 'required|file|mimes:jpg,png|max:10240',
            'submission_date' => 'required|date',
        ]);

        // Store files and data
        $portfolioSamplesPath = $request->file('portfolio_samples')->store('subcontractor_attachments');
        $businessLicensesPath = $request->file('business_licenses')->store('subcontractor_attachments');
        $signaturePath = $request->file('signature')->store('subcontractor_attachments');

        // Create the attachment record in the database
        SubcontractorAttachment::create([
            'subcontractor_id' => $request->subcontractor_id,  // Ensure subcontractor_id is saved
            'portfolio_samples' => $portfolioSamplesPath,
            'business_licenses' => $businessLicensesPath,
            'agreement_acknowledged' => $request->agreement_acknowledged,
            'signature' => $signaturePath,
            'submission_date' => $request->submission_date,
        ]);

        // Redirect with success message
        return redirect()->route('attachments.index')
                         ->with('success', 'Subcontractor attachment created successfully!');
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
