<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::all(); // Fetch all vendors
    return view('Vendor.Vendor.index', compact('vendors')); // Pass vendors collection to view
    }

    // Show the form for creating a new vendor
    public function create()
    {
        return view('vendor.vendor.create');
    }

    // Store a newly created vendor in storage
    public function store(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required|string|max:255|unique:vendors', // Ensure vendor_name is unique
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'business_license' => 'nullable|string',
            'tax_information' => 'nullable|string',
            'service_category' => 'required|string|in:Airlines,Rail Companies,Bus/Coach Operators,Car Rental Agencies,Cruise Lines',
            'contract_start_date' => 'nullable|date',
            'contract_end_date' => 'nullable|date',
        ]);
    
        // Create a new vendor
        Vendor::create($request->only([
            'vendor_name', 'email', 'phone', 'business_license', 'tax_information', 'service_category', 'contract_start_date', 'contract_end_date'
        ]));
    
        return redirect()->route('vendor.index')->with('success', 'Vendor created successfully.');
    }
    

    // Show the details of a specific vendor
    public function show(Vendor $vendor)
    {
        return view('vendor.vendor.show', compact('vendor'));
    }

    // Show the form for editing a specific vendor
    public function edit(Vendor $vendor)
    {
        return view('Vendor.Vendor.edit', compact('vendor')); // Ensure 'vendor' is passed to the view
    }

    // Update the vendor in storage
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'vendor_name' => 'required|string|max:255|unique:vendors,vendor_name,' . $vendor->id, // Allow current vendor name
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'business_license' => 'nullable|string',
            'tax_information' => 'nullable|string',
            'service_category' => 'required|string',
            'contract_start_date' => 'nullable|date',
            'contract_end_date' => 'nullable|date',
        ]);

        $vendor->update($request->only([
            'vendor_name', 'email', 'phone', 'business_license', 'tax_information', 'service_category', 'contract_start_date', 'contract_end_date'
        ]));

        return redirect()->route('vendor.index')->with('success', 'Vendor updated successfully.');
    }

    // Delete a vendor from storage
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    }
}
