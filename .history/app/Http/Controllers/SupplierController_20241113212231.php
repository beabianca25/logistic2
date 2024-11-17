<?php

namespace App\Http\Controllers;

use App\Models\subcontractor;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $subcontractors = subcontractor::all();
        return view('vendor.supplier.index', compact('suppliers', 'subcontractors'));
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
    public function store(Request $request)  // Corrected to use Request
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'product_service_description' => 'required',
            'price_quote' => 'required|numeric',
            'availability_lead_time' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'attachments' => 'nullable|file',
        ]);

        if ($request->hasFile('attachments')) {
            $validatedData['attachments'] = $request->file('attachments')->store('attachments', 'public'); // Save to 'public' disk
        }

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
            'status' => 'required|in:Pending,Admin_Review,Buyer_Approved,Manager_Approved',
        ]);

        if ($request->hasFile('attachments')) {
            $validatedData['attachments'] = $request->file('attachments')->store('attachments', 'public'); // Save to 'public' disk
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
