<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorContact;
use Illuminate\Http\Request;

class VendorContactController extends Controller
{
    /**
     * Display a listing of contacts for a specific vendor.
     */
    public function index($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
        $contacts = $vendor->contacts;
        return view('Vendor.VendorContact.index', compact('vendor', 'contacts'));
    }

    /**
     * Show the form for creating a new contact for a specific vendor.
     */
    public function create($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
        return view('Vendor.VendorContact.create', compact('vendor'));
    }

    
    /**
     * Store a newly created contact in storage.
     */
    public function store(Request $request, $vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
    
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);
    
        $validated['vendor_id'] = $vendor->id;
    
        VendorContact::create($validated);
    
        return redirect()->route('vendorservice.create', ['vendorId' => $vendor->id])
        ->with('success', 'Contact added successfully. Proceed to Consent.');


    }
    
    /**
     * Display the specified contact.
     */
    public function show($vendorId, $contactId)
    {
        $contact = VendorContact::where('vendor_id', $vendorId)->findOrFail($contactId);
        return view('Vendor.VendorContact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit($vendorId, $contactId)
    {
        $contact = VendorContact::where('vendor_id', $vendorId)->findOrFail($contactId);
        return view('Vendor.VendorContact.edit', compact('contact'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, $vendorId, $contactId)
    {
        $contact = VendorContact::where('vendor_id', $vendorId)->findOrFail($contactId);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $contact->update($validated);

        return redirect()->route('vendorcontact.index', $vendorId)
                         ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy($vendorId, $contactId)
    {
        $contact = VendorContact::where('vendor_id', $vendorId)->findOrFail($contactId);
        $contact->delete();

        return redirect()->route('vendorcontact.index', $vendorId)
                         ->with('success', 'Contact deleted successfully.');
    }
}
