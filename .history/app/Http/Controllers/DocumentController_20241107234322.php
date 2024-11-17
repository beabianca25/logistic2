<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Controllers\Controller;
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
        $documents = Document::all();
        $vendors = Vendor::all();
        return view('document.document.index', compact('documents', 'vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $document = Document::all();
        return view('document.index', compact('document'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'vendor_id' => 'required|exists:vendors,id',
            'document_title' => 'required|string|max:255',
            'file_path' => 'required|string',
            'department' => 'required|string|max:255',
            'purpose' => 'nullable|string',
        ]);

        // Upload the file
        $filePath = $request->file('file')->store('documents', 'public');

        // Create document record
        $document = Document::create([
            'vendor_id' => $request->vendor_id,
            'document_title' => $request->document_title,
            'document_number' => $request->document_number,
            'file_path' => $filePath,
            'department' => $request->department,
            'current_holder' => $request->current_holder,
            'purpose' => $request->purpose,
            'status' => $request->status,
        ]);

        return redirect()->route('document.index')->with('success', 'Document uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('document.document.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $document = Document::findOrFail($document);
        return view('document.document.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $document = Document::findOrFail($document);

        $request->validate([
            'document_title' => 'required|string|max:255',
            'document_number' => 'required|string|unique:documents,document_number,' . $document->id,
            'file' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'department' => 'required|string',
            'status' => 'required|in:active,inactive,archived',
        ]);

        // Update file if provided
        if ($request->hasFile('file')) {
            // Delete old file if it exists
            Storage::delete($document->file_path);

            // Store new file
            $filePath = $request->file('file')->store('documents', 'public');
            $document->file_path = $filePath;
        }

        // Update other details
        $document->update([
            'document_title' => $request->document_title,
            'document_number' => $request->document_number,
            'department' => $request->department,
            'current_holder' => $request->current_holder,
            'purpose' => $request->purpose,
            'status' => $request->status,
        ]);

        return redirect()->route('document.index')->with('success', 'Document updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $document = Document::findOrFail($document);

        // Delete file from storage
        Storage::delete($document->file_path);

        // Delete document record
        $document->delete();

        return redirect()->route('document.index')->with('success', 'Document deleted successfully!');
    }
}
