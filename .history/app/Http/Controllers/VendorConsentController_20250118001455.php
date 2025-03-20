<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorConsent;

class VendorConsentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consents = VendorConsent::all();
        return view('Vendor.VendorConsent.index', compact('consents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendorId = 1; // Replace this with logic to get the actual vendor ID if needed
        return view('Vendor.VendorConsent.create', compact('vendorId'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'authorized_person_name' => 'required|string|max:255',
            'contract_email' => 'required|email|max:255',
            'agreement_to_terms' => 'required|in:Yes,No',
            'agreement_to_credit_check' => 'required|in:Yes,No',
            'signature' => 'required|string',
        ]);
    
        // Create the consent record
        VendorConsent::create($validatedData);
    
        // Redirect to the vendor service page
        return redirect()->route('vendorservice.create', $validatedData['vendor_id'])
                         ->with('success', 'Vendor consent record created successfully. Proceed to vendor service.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consent = VendorConsent::findOrFail($id);
        return view('Vendor.VendorConsent.show', compact('consent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consent = VendorConsent::findOrFail($id);
        return view('Vendor.VendorConsent.edit', compact('consent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'authorized_person_name' => 'required|string|max:255',
            'contract_email' => 'required|email|max:255',
            'agreement_to_terms' => 'required|in:Yes,No',
            'agreement_to_credit_check' => 'required|in:Yes,No',
            'signature' => 'required|string',
        ]);

        $consent = VendorConsent::findOrFail($id);
        $consent->update($validatedData);

        return redirect()->route('vendorconsent.index')->with('success', 'Vendor consent record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consent = VendorConsent::findOrFail($id);
        $consent->delete();

        return redirect()->route('vendorconsent.index')->with('success', 'Vendor consent record deleted successfully.');
    }
}
