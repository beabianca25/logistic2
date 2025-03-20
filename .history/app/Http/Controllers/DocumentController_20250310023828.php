<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\OcrService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    protected $ocrService;

    public function __construct(OcrService $ocrService)
    {
        $this->ocrService = $ocrService;
    }

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

    // Store a new document with OCR extraction
    public function store(Request $request)
    {
        $request->validate([
            'document_title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg',
            'department' => 'required|string|max:255',
            'current_holder' => 'nullable|string|max:255',
            'purpose' => 'nullable|string',
            'status' => 'required|in:Pending,Approved,Rejected,Active,Inactive,Archived',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('documents', 'public');

        // Extract text from document using OCR
        $extractedText = null;
        if (in_array($file->getClientOriginalExtension(), ['png', 'jpg', 'jpeg'])) {
            $extractedText = $this->ocrService->extractText($filePath);
        }

        // Store in database
        Document::create([
            'document_title' => $request->document_title,
            'file_path' => $filePath,
            'department' => $request->department,
            'current_holder' => $request->current_holder,
            'purpose' => $request->purpose,
            'status' => $request->status,
            'extracted_text' => $extractedText,
        ]);

        return redirect()->route('document.index')->with('success', 'Document uploaded and processed successfully');
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
            'file' => 'nullable|file|mimes:pdf,png,jpg,jpeg',
            'department' => 'required|string|max:255',
            'current_holder' => 'nullable|string|max:255',
            'purpose' => 'nullable|string',
            'status' => 'required|in:Pending,Approved,Rejected,Active,Inactive,Archived',
        ]);

        $document = Document::findOrFail($id);
        $filePath = $document->file_path;
        $extractedText = $document->extracted_text;

        if ($request->hasFile('file')) {
            // Delete old file
            if (Storage::exists("public/{$document->file_path}")) {
                Storage::delete("public/{$document->file_path}");
            }

            $file = $request->file('file');
            $filePath = $file->store('documents', 'public');

            // Re-extract text for images
            if (in_array($file->getClientOriginalExtension(), ['png', 'jpg', 'jpeg'])) {
                $extractedText = $this->ocrService->extractText($filePath);
            }
        }

        $document->update([
            'document_title' => $request->document_title,
            'file_path' => $filePath,
            'department' => $request->department,
            'current_holder' => $request->current_holder,
            'purpose' => $request->purpose,
            'status' => $request->status,
            'extracted_text' => $extractedText,
        ]);

        return redirect()->route('document.index')->with('success', 'Document updated successfully');
    }

    // Delete a document
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Delete file
        if (Storage::exists("public/{$document->file_path}")) {
            Storage::delete("public/{$document->file_path}");
        }

        $document->delete();

        return redirect()->route('document.index')->with('success', 'Document deleted successfully');
    }

    public function getPendingDocumentCount()
    {
        $pendingDocumentCount = Document::where('status', 'pending')->count();
        return response()->json(['pendingDocumentCount' => $pendingDocumentCount]);
    }
}
