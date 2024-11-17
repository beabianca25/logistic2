<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index() {
        $supplies = Supply::all();
        return view('audit.supply.index', compact('supplies'));
    }

    public function create() {
        return view('audit.supply.create');
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'supply_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'audit_date' => 'required|date',
            'location' => 'required|string|max:255',
            'condition' => 'required|string',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
            'auditor_name' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        // Create the supply record
        Supply::create($validated);

        return redirect()->route('supply.index')->with('success', 'Supply added successfully.');

    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}


    public function show(Supply $supply) {
        return view('audit.supply.show', compact('supply'));
    }

    public function edit(Supply $supply) {
        return view('audit.supply.edit', compact('supply'));
    }

    public function update(Request $request, Supply $supply) {
        $validated = $request->validate([
            'supply_name' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'audit_date' => 'required|date',
            'location' => 'required',
            'condition' => 'required',
            'status' => 'required',
            'remarks' => 'nullable',
            'auditor_name' => 'required',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $supply->update($validated);

        return redirect()->route('supply.index')->with('success', 'Supply updated successfully.');
    }

    public function destroy(Supply $supply) {
        $supply->delete();
        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }
}
