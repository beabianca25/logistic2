<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierReference;
use Illuminate\Http\Request;

class SupplierReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplierreferences = SupplierReference::all();
        return view('Supplier.SupplierReference.index', compact('supplierreferences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($supplier_id)
    {
        $supplier = Supplier::findOrFail($supplier_id);
        return view('Supplier.SupplierReference.create', compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $supplierId)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);
    
        // Find the supplier using the supplierId
        $supplier = Supplier::findOrFail($supplierId);
    
        // Create a new supplier reference using the validated data
        SupplierReference::create([
            'supplier_id' => $supplier->id,
            'client_name' => $validatedData['client_name'],
            'client_contact' => $validatedData['client_contact'],
            'project_description' => $validatedData['project_description'],
        ]);
    
        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Supplier reference created successfully. A status update has been sent to your email.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplierreference = SupplierReference::findOrFail($id);
        return view('Supplier.SupplierReference.show', compact('supplierreference')); // Fixed variable name
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplierreference = SupplierReference::findOrFail($id);
        return view('Supplier.SupplierReference.edit', compact('supplierreference')); // Fixed variable name
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);

        $supplierreference = SupplierReference::findOrFail($id);
        $supplierreference->update($validated);

        return redirect()->route('supplierreference.index')->with('success', 'Supplier Reference updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplierreference = SupplierReference::findOrFail($id);
        $supplierreference->delete();

        return redirect()->route('supplierreference.index')->with('success', 'Supplier Reference deleted successfully.');
    }
}
