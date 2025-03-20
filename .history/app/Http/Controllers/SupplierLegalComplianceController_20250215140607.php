<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierLegalCompliance;
use Illuminate\Http\Request;

class SupplierLegalComplianceController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $legalcompliances = SupplierLegalCompliance::all();
        $suppliers = Supplier::all();
        return view('Supplier.LegalCompliance.index', compact('legalcompliances', 'suppliers'));
    }

    // Show the form for creating a new resource.
    public function create($supplier_id)
    {
        // Find the supplier by ID or fail
        $supplier = Supplier::findOrFail($supplier_id);

        // Pass the supplier data to the view
        return view('Supplier.legalcompliance.create', compact('supplier'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'registration_number' => 'required|string',
            'tax_identification_number' => 'required|string',
            'licenses_certifications' => 'required|string',
            'years_of_operation' => 'required|integer',
        ]);

        SupplierLegalCompliance::create($validated);

        // Redirect to productservice.create with the supplier ID
        return redirect()->route('productservice.create', ['supplier_id' => $request->supplier_id])
            ->with('success', 'Supplier Legal Compliance created successfully. Please continue to add Product/Service details.');
    }


    // Display the specified resource.
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('Supplier.Supplier.show', compact('supplier'));
    }



    // Show the form for editing the specified resource.
    public function edit(SupplierLegalCompliance $supplierLegalCompliance)
    {
        return view('Supplier.LegalCompliance.edit', compact('supplierLegalCompliance'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, SupplierLegalCompliance $supplierLegalCompliance)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'registration_number' => 'required|string',
            'tax_identification_number' => 'required|string',
            'licenses_certifications' => 'required|string',
            'years_of_operation' => 'required|integer',
        ]);

        $supplierLegalCompliance->update($validated);

        return redirect()->route('LegalCompliance.index')->with('success', 'Supplier Legal Compliance updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(SupplierLegalCompliance $supplierLegalCompliance)
    {
        $supplierLegalCompliance->delete();

        return redirect()->route('LegalCompliance.index')->with('success', 'Supplier Legal Compliance deleted successfully.');
    }
}
