<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the vendors.
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view('Vendor.Vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new vendor.
     */
    public function create()
    {
        $vendorId = 1; // Replace this with logic to get the actual vendor ID if needed
        return view('Vendor.Vendor.create', compact('vendorId'));
    }

    /**
     * Store a newly created vendor in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'industry_segment' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|string|max:255',
            'geographical_coverage' => 'nullable|string|max:255',
            'business_address' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255',
            'website_url' => 'nullable|url|max:255',
        ]);
    
        $vendor = Vendor::create($validated);
    
        return redirect()->route('vendorcontact.create', ['vendorId' => $vendor->id])
        ->with('success', 'Contact added successfully. Proceed to Consent.');

    }
    
    /**
     * Display th e specified vendor.
     */
    public function show($id)
    {
        
        // Fetch the vendor with all related data
        $vendor = Vendor::with([
            'certifications', 
            'consents', 
            'contacts', 
            'reviews', 
            'services', 
            'invoices'
        ])->findOrFail($id);

        $contact = $vendor->contacts->first();
        $service = $vendor->services->first(); 

        return view('Vendor.Vendor.show', compact(
            'vendor', 'contact', 'services'
        ));
    }
    

    /**
     * Update the specified vendor in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'industry_segment' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|integer',
            'geographical_coverage' => 'nullable|string|max:255',
            'business_address' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255',
            'website_url' => 'nullable|url|max:255',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update($validated);

        return redirect()->route('vendor.index')->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified vendor from storage.
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    }
}
