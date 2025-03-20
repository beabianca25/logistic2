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
        return view('Supplier.SupplierReference.index', compact('references'));
    }

    /**
     * Show the form for creating a new supplier reference.
     */
    public function create($supplier_id)
    {
        // Find the supplier by ID
        $supplier = Supplier::findOrFail($supplier_id);
    
        // Pass the supplier to the view
        return view('Supplier.SupplierReference.create', compact('supplier'));
    }
    

    /**
     * Store a newly created supplier reference in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);
    
        // Create a new supplier reference
        SupplierReference::create([
            'supplier_id' => $request->supplier_id,
            'client_name' => $request->client_name,
            'client_contact' => $request->client_contact,
            'project_description' => $request->project_description,
        ]);
    
        // Redirect to a suitable page, for example, the supplier references index
        return redirect()->route('SupplierReference.index')->with('success', 'Supplier reference created successfully.');
    }
    
    /**
     * Show the form for editing the specified supplier reference.
     */
    public function edit(SupplierReference $supplierReference)
    {
        $suppliers = Supplier::all();
        return view('Supplier.SupplierReference.edit', compact('supplierReference', 'suppliers'));
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

        return redirect()->route('SupplierReference.index')
            ->with('success', 'Supplier reference updated successfully.');
    }

    /**
     * Remove the specified supplier reference from the database.
     */
    public function destroy(SupplierReference $supplierReference)
    {
        $supplierReference->delete();

        return redirect()->route('SupplierReference.index')
            ->with('success', 'Supplier reference deleted successfully.');
    }
}
