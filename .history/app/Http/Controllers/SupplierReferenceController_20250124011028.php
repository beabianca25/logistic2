<?php

namespace App\Http\Controllers;

use App\Models\SupplierReference;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierReferenceController extends Controller
{
    /**
     * Display a listing of the supplier references.
     */
    public function index()
    {
        $references = SupplierReference::all();
        return view('supplier_references.index', compact('references'));
    }

    /**
     * Show the form for creating a new supplier reference.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('supplier_references.create', compact('suppliers'));
    }

    /**
     * Store a newly created supplier reference in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);

        SupplierReference::create($request->all());

        return redirect()->route('supplier_references.index')
            ->with('success', 'Supplier reference created successfully.');
    }

    /**
     * Show the form for editing the specified supplier reference.
     */
    public function edit(SupplierReference $supplierReference)
    {
        $suppliers = Supplier::all();
        return view('supplier_references.edit', compact('supplierReference', 'suppliers'));
    }

    /**
     * Update the specified supplier reference in the database.
     */
    public function update(Request $request, SupplierReference $supplierReference)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);

        $supplierReference->update($request->all());

        return redirect()->route('supplier_references.index')
            ->with('success', 'Supplier reference updated successfully.');
    }

    /**
     * Remove the specified supplier reference from the database.
     */
    public function destroy(SupplierReference $supplierReference)
    {
        $supplierReference->delete();

        return redirect()->route('supplier_references.index')
            ->with('success', 'Supplier reference deleted successfully.');
    }
}
