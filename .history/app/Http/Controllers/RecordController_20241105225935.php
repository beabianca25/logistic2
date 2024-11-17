<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        $records = Record::all(); // Fetch all audit records
        return view('audit.record.index', compact('records')); // Pass correct variable
    }

    public function create()
    {
        return view('audit.record.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'auditor_name' => 'required|string',
            'audit_type' => 'required|in:supplies,assets',
            'item_or_asset_name' => 'required|string',
            'condition' => 'required|string',
            'notes' => 'nullable|string',
            'audit_date' => 'required|date',
            'status' => 'required|string',
            'actions_taken' => 'nullable|string',
        ]);
    
       Record::create($request->all()); // Use updated model name
    
        return redirect()->route('record.index')->with('success', 'Audit record created successfully.');
    }

    public function show($record)
    {

        
        return view('audit.record.show', compact('record'));
    }
    

    public function edit(Record $record) // Update parameter type
    {
        return view('audit.record.edit', compact('record')); // Change to correct variable
    }

    public function update(Request $request, Record $record) {
        $request->validate([
            'auditor_name' => 'required|string',
            'audit_type' => 'required|in:supplies,assets',
            'item_or_asset_name' => 'required|string',
            'condition' => 'required|string',
            'notes' => 'nullable|string',
            'audit_date' => 'required|date',
            'status' => 'required|string',
            'actions_taken' => 'nullable|string',
        ]);
    
        $record->update($request->all());
    
        return redirect()->route('record.index')->with('success', 'Audit record updated successfully.');
    }
    
    

    public function destroy(Record $record) // Update parameter type
    {
        $record->delete();

        return redirect()->route('record.index')->with('success', 'Audit record deleted successfully.');
    }
}
