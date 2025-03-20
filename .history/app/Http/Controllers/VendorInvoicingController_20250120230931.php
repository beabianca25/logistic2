<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorInvoicing;

class VendorInvoicingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = VendorInvoicing::all();
        return view('Vendor.VendorInvoicing.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($vendorId)
    {
        // Fetch the vendor by the provided vendor ID
        $vendor = Vendor::findOrFail($vendorId);
    
        // Pass the vendor object to the view
        return view('Vendor.VendorInvoicing.create', compact('vendor'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $vendorId)
    {
        $validatedData = $request->validate([
            'accounts_payable_name' => 'required|string|max:255',
            'accounts_payable_email' => 'required|email|max:255',
            'postal_address' => 'nullable|string',
            'requires_po' => 'required|in:Yes,No',
            'additional_instructions' => 'nullable|string',
        ]);
    
        // Ensure you use the vendorId to link the invoice to the correct vendor
        $validatedData['vendor_id'] = $vendorId;
    
        VendorInvoicing::create($validatedData);
    
        return redirect()->route('vendorreview.create', ['vendorId' => $vendorId]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = VendorInvoicing::findOrFail($id);
        return view('Vendor.VendorInvoicing.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = VendorInvoicing::findOrFail($id);
        return view('Vendor.VendorInvoicing.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'accounts_payable_name' => 'required|string|max:255',
            'accounts_payable_email' => 'required|email|max:255',
            'postal_address' => 'nullable|string',
            'requires_po' => 'required|in:Yes,No',
            'additional_instructions' => 'nullable|string',
        ]);

        $invoice = VendorInvoicing::findOrFail($id);
        $invoice->update($validatedData);

        return redirect()->route('vendorinvoicing.index')->with('success', 'Vendor Invoicing record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invoice = VendorInvoicing::findOrFail($id);
        $invoice->delete();

        return redirect()->route('vendorinvoicing.index')->with('success', 'Vendor Invoicing record deleted successfully.');
    }
}
