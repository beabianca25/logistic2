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
    public function index($supplier_id)
    {
        $supplierreferences = SupplierReference::all();
        return view('Supplier.SupplierReference.index', compact('supplierreferences'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($supplier_id)
    {
        // Ensure supplier exists
        $supplier = Supplier::findOrFail($supplier_id);
        return view('Supplier.SupplierReference.create', compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $supplier_id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);
        
        // Find the supplier using the supplierId
        $supplier = Supplier::findOrFail($supplier_id);
        
        // Create a new supplier reference using the validated data
        SupplierReference::create([
            'supplier_id' => $supplier->id,
            'client_name' => $validatedData['client_name'],
            'client_contact' => $validatedData['client_contact'],
            'project_description' => $validatedData['project_description'],
        ]);
        
      // Redirect to the supplier reference index page, passing the supplier_id
return redirect()->route('supplierreference.index', ['supplier_id' => $request->supplier_id])
->with('success', 'Supplier reference created successfully.');

    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the specific SupplierReference by ID
        $supplierreference = SupplierReference::findOrFail($id);
        return view('Supplier.SupplierReference.show', compact('supplierreference'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the supplier reference to be edited
        $supplierreference = SupplierReference::findOrFail($id);
        return view('Supplier.SupplierReference.edit', compact('supplierreference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data for updating
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);

        // Fetch the specific SupplierReference by ID
        $supplierreference = SupplierReference::findOrFail($id);
        
        // Update the supplier reference data
        $supplierreference->update($validated);

        // Redirect with success message after updating
        return redirect()->route('supplierreference.index')->with('success', 'Supplier Reference updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete the specific SupplierReference
        $supplierreference = SupplierReference::findOrFail($id);
        $supplierreference->delete();

        // Redirect after deletion
        return redirect()->route('supplierreference.index')->with('success', 'Supplier Reference deleted successfully.');
    }
}
