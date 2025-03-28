<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Display a list of documents
    public function index()
    {
        $documents = Document::all();
        return view('Document.Document.index', compact('documents'));
    }

    // Show the form to create a new document
    public function create()
    {
        return view('Document.Document.create');
    }

    // Store a new document
    public function store(Request $request)
    {
        $request->validate([
            'document_title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg', // Only allow PDF, DOC, DOCX, PNG, JPG, JPEG
            'department' => 'required|string|max:255',
            'current_holder' => 'nullable|string|max:255',
            'purpose' => 'nullable|string',
            'status' => 'required|in:Pending,Approved,Rejected,Active,Inactive,Archived',
        ]);
        

        $filePath = $request->file('file')->store('documents', 'public'); // Store file in public storage

        Document::create([
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
        return view('Document.Document.show', compact('document'));
    }

    // Show the form to edit a document
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('Document.Document.edit', compact('document'));
    }

    // Update a document
    public function update(Request $request, $id)
    {
        $request->validate([
            'document_title' => 'required|string|max:255',
            'file' => 'nullable|file',
            'department' => 'required|string|max:255',
            'current_holder' => 'nullable|string|max:255',
            'purpose' => 'nullable|string',
            'status' => 'required|in:Pending,Approved,Rejected,Active,Inactive,Archived',
        ]);

        $document = Document::findOrFail($id);

        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if (Storage::exists("public/{$document->file_path}")) {
                Storage::delete("public/{$document->file_path}");
            }

            $filePath = $request->file('file')->store('documents', 'public');
        } else {
            $filePath = $document->file_path; // Keep existing file path
        }

        $document->update([
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
        if (Storage::exists("public/{$document->file_path}")) {
            Storage::delete("public/{$document->file_path}");
        }

        $document->delete();

        return redirect()->route('document.index')->with('success', 'Document deleted successfully');
    }
}
