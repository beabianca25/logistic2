<?php

namespace App\Http\Controllers;

use App\Models\Document_Request;
use Illuminate\Http\Request;

class DocumentRequestController extends Controller
{
    // Display a listing of the document requests
    public function index()
    {
        $documentrequests = Document_Request::all();
        return view('document.request.index', compact('documentrequests'));
    }

    // Show the form for creating a new document request
    public function create()
    {
        return view('document.request.create');
    }

    // Store a newly created document request in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'requester_name' => 'required|string|max:255',
            'request_date' => 'required|date',
            'data_type' => 'required|string|max:255',
            'description' => 'required|string',
            'priority_level' => 'required|in:Low,Medium,High,Urgent',
            'deadline' => 'nullable|date',
            'status' => 'required|in:Pending,In Progress,Completed,Canceled',
            'assigned_to' => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        Document_Request::create($validatedData);

        return redirect()->route('request.index')
            ->with('success', 'Document request created successfully.');
    }

    // Display the specified document request
    public function show($id)
    {
        $documentrequest = Document_Request::findOrFail($id);
        return view('document.request.show', compact('documentrequest'));
    }

    // Show the form for editing the specified document request
    public function edit($id)
    {
        $documentrequest = Document_Request::findOrFail($id);
        return view('document.request.edit', compact('documentrequest'));
    }

    // Update the specified document request in storage
    public function update(Request $request, $id)
    {
        $documentrequest = Document_Request::findOrFail($id);

        $validatedData = $request->validate([
            'requester_name' => 'required|string|max:255',
            'request_date' => 'required|date',
            'data_type' => 'required|string|max:255',
            'description' => 'required|string',
            'priority_level' => 'required|in:Low,Medium,High,Urgent',
            'deadline' => 'nullable|date',
            'status' => 'required|in:Pending,In Progress,Completed,Canceled',
            'assigned_to' => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        $documentrequest->update($validatedData);

        return redirect()->route('request.index')
            ->with('success', 'Document request updated successfully.');
    }

    // Remove the specified document request from storage
    public function destroy($id)
    {
        $documentrequest = Document_Request::findOrFail($id);
        $documentrequest->delete();

        return redirect()->route('request.index')
            ->with('success', 'Document request deleted successfully.');
    }
}
