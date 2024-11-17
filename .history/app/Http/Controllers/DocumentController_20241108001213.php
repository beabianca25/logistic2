<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Display a list of documents
    public function index()
    {
        // Fetch all vendors
    $vendors = Vendor::all(); 

    // Fetch all documents
    $documents = Document::all();

    return view('Document.document.index', compact('documents', 'vendors'));
    }

    // Show the form to create a new document
    public function create()
    {
        $vendors = Vendor::all(); // Get all vendors for selection
        return view('document.document.create', compact('vendors'));
    }

    // Store a new document
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'document_title' => 'required|string|max:255',
            'file' => 'required|file',
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,archived',
        ]);

        $filePath = $request->file('file')->store('documents', 'public'); // Store file in public storage

        Document::create([
            'vendor_id' => $request->vendor_id,
            'document_title' => $request->document_title,
            'file_path' => $filePath,
            'department' => $request->department,
            'current_holder' => $request->current_holder,
            'purpose' => $request->purpose,
            'status' => $request->status,
        ]);

        return redirect()->route('document.index')->with('success', 'Document uploaded successfully');
    }

    // Show a specific document
    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('document.document.show', compact('document'));
    }

    // Show the form to edit a document
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $vendors = Vendor::all();
        return view('document.document.edit', compact('document', 'vendors'));
    }

    // Update a document
    public function update(Request $request, $id)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'document_title' => 'required|string|max:255',
            'file' => 'nullable|file',
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,archived',
        ]);

        $document = Document::findOrFail($id);

        if ($request->hasFile('file')) {
            // Delete the old file if exists
            if (Storage::exists($document->file_path)) {
                Storage::delete($document->file_path);
            }

            $filePath = $request->file('file')->store('documents', 'public');
        } else {
            $filePath = $document->file_path; // Keep the old file path if no new file is uploaded
        }

        $document->update([
            'vendor_id' => $request->vendor_id,
            'document_title' => $request->document_title,
            'file_path' => $filePath,
            'department' => $request->department,
            'current_holder' => $request->current_holder,
            'purpose' => $request->purpose,
            'status' => $request->status,
        ]);

        return redirect()->route('document.index')->with('success', 'Document updated successfully');
    }

    // Delete a document
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Delete the file from storage
        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('document.index')->with('success', 'Document deleted successfully');
    }
}
