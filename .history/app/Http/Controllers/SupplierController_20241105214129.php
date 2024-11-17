<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('vendor.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Supplier $request)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'product_service_description' => 'required',
            'price_quote' => 'required|numeric',
            'availability_lead_time' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'attachments' => 'nullable|file',
        ]);

        $validatedData['attachments'] = $request->file('attachments') ? $request->file('attachments')->store('attachments') : null;

        Supplier::create($validatedData);

        return redirect()->route('supplier.index')->with('success', 'Supplier request submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('vendor.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('vendor.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'product_service_description' => 'required',
            'price_quote' => 'required|numeric',
            'availability_lead_time' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'attachments' => 'nullable|file',
        ]);

        if ($request->file('attachments')) {
            $validatedData['attachments'] = $request->file('attachments')->store('attachments');
        }

        $supplier->update($validatedData);

        return redirect()->route('supplier.index')->with('success', 'Supplier request updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier request deleted successfully');
    }
}
