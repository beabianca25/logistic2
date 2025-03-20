<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    public function create()
    {
        return view('Supplier.SupplierReference.create', compact('supplierreference'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'client_name' => 'required|string',
            'client_contact' => 'required|string',
            'project_description' => 'required|string',
        ]);

        SupplierReference::create($validated);

        return redirect()->route('supplierreference.index')->with('success', 'Supplier Reference created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplierReference = SupplierReference::findOrFail($id);
        return view('Supplier.SupplierReference.show', compact('supplierreference'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplierReference = SupplierReference::findOrFail($id);
        return view('Supplier.SupplierReference.edit', compact('supplierreference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'client_name' => 'required|string',
            'client_contact' => 'required|string',
            'project_description' => 'required|string',
        ]);

        $supplierReference = SupplierReference::findOrFail($id);
        $supplierReference->update($validated);

        return redirect()->route('supplierreference.index')->with('success', 'Supplier Reference updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplierReference = SupplierReference::findOrFail($id);
        $supplierReference->delete();

        return redirect()->route('supplierreference.index')->with('success', 'Supplier Reference deleted successfully.');
    }
}
