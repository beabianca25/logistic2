<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorCertification;
use App\Models\VendorConsent;
use App\Models\VendorContact;
use App\Models\VendorService;
use App\Models\VendorInvoicing;
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
        return view('Vendor.Vendor.create');
    }

    /**
     * Store a newly created vendor in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vendors',
            'business_type' => 'required|string|max:255',
            'industry_segment' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|integer|min:1',
            'geographical_coverage' => 'nullable|string|max:255',
            'business_address' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255|unique:vendors',
            'website_url' => 'nullable|url|max:255',
        ]);

        $vendor = Vendor::create($validated);

        return redirect()->route('vendorcontact.create', ['vendorId' => $vendor->id])
            ->with('success', 'Vendor added successfully. Proceed to add contact.');
    }

    /**
     * Display the specified vendor.
     */
    public function show($id)
    {
        $vendor = Vendor::with([
            'certifications',
            'consents',
            'contacts',
            'reviews',
            'services',
            'invoices'
        ])->findOrFail($id);

        return view('Vendor.Vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing a vendor.
     */
    public function edit($id)
    {
        $vendor = Vendor::with([
            'certifications',
            'consents',
            'contacts',
            'services',
            'invoices'
        ])->findOrFail($id);

        return view('Vendor.Vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified vendor in storage.
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vendors,registration_number,' . $id,
            'business_type' => 'required|string|max:255',
            'industry_segment' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|integer|min:1',
            'geographical_coverage' => 'nullable|string|max:255',
            'business_address' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255|unique:vendors,contact_email,' . $id,
            'website_url' => 'nullable|url|max:255',
        ]);

        $vendor->update($validated);

        // Update related models if present in the request
        if ($request->has('certifications')) {
            foreach ($request->certifications as $certificationId => $certData) {
                VendorCertification::where('id', $certificationId)->update($certData);
            }
        }

        if ($request->has('consents')) {
            foreach ($request->consents as $consentId => $consentData) {
                VendorConsent::where('id', $consentId)->update($consentData);
            }
        }

        if ($request->has('contacts')) {
            foreach ($request->contacts as $contactId => $contactData) {
                VendorContact::where('id', $contactId)->update($contactData);
            }
        }

        if ($request->has('services')) {
            foreach ($request->services as $serviceId => $serviceData) {
                VendorService::where('id', $serviceId)->update($serviceData);
            }
        }

        if ($request->has('invoices')) {
            foreach ($request->invoices as $invoiceId => $invoiceData) {
                VendorInvoicing::where('id', $invoiceId)->update($invoiceData);
            }
        }

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
