<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $vendors = Vendor::all();  // Get all vendors
    $documents = Document::all();
    return view('document.document.create', compact('documents','vendors'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch vendors for the create view
        $vendors = Vendor::all();

        // Return create view with vendors data
        return view('document.document.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'document_title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'department' => 'required|string|max:255',
            'purpose' => 'nullable|string',
            'status' => 'required|in:active,inactive,archived',  // Added status validation
        ]);

        try {
            // Handle file upload
            $file = $request->file('file');
            $filePath = $file->store('documents', 'public');  // Store the file in the public directory

            // Create the document record in the database
            Document::create([
                'vendor_id' => $request->vendor_id,
                'document_title' => $request->document_title,
                'file_path' => $filePath,
                'department' => $request->department,
                'current_holder' => $request->current_holder,
                'purpose' => $request->purpose,
                'status' => $request->status,
            ]);

            // Redirect with success message
            return redirect()->route('document.index')->with('success', 'Document uploaded successfully!');
        } catch (\Exception $e) {
            // Log the error and show an error message
            \Log::error('Error storing document: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while uploading the document.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        // Return the show view with the document details
        return view('document.document.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        // Return edit view with the document data
        $vendors = Vendor::all();  // Fetch vendors for the edit view
        return view('document.document.edit', compact('document', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        // Validate the incoming request
        $request->validate([
            'document_title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,archived',
            'purpose' => 'nullable|string',
        ]);

        try {
            // Update file if a new one is uploaded
            if ($request->hasFile('file')) {
                // Delete the old file if it exists
                Storage::delete($document->file_path);

                // Store the new file
                $filePath = $request->file('file')->store('documents', 'public');
                $document->file_path = $filePath;
            }

            // Update other document details
            $document->update([
                'document_title' => $request->document_title,
                'department' => $request->department,
                'current_holder' => $request->current_holder,
                'purpose' => $request->purpose,
                'status' => $request->status,
            ]);

            // Redirect with success message
            return redirect()->route('document.index')->with('success', 'Document updated successfully!');
        } catch (\Exception $e) {
            // Log the error and show an error message
            \Log::error('Error updating document: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the document.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        try {
            // Delete the file from storage
            Storage::delete($document->file_path);

            // Delete the document record from the database
            $document->delete();

            // Redirect with success message
            return redirect()->route('document.index')->with('success', 'Document deleted successfully!');
        } catch (\Exception $e) {
            // Log the error and show an error message
            \Log::error('Error deleting document: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the document.');
        }
    }
}
