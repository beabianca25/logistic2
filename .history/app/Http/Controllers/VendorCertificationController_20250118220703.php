<?php

namespace App\Http\Controllers;

use App\Models\VendorCertification;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorCertificationController extends Controller
{
    /**
     * Display a listing of certifications for a specific vendor.
     */
    public function index($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
        $certifications = $vendor->certifications;
        return view('Vendor.VendorCertification.index', compact('vendor', 'certifications'));
    }

    /**
     * Show the form for creating a new certification for a specific vendor.
     */
    public function create($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
        return view('Vendor.VendorCertification.create', compact('vendor'));
    }

    /**
     * Store a newly created certification in storage.
     */
    public function store(Request $request, $vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);

        $validated = $request->validate([
            'certification_name' => 'required|string|max:255',
            'certification_type' => 'required|in:Business License,Safety Certification,Insurance Document,Other',
            'file_path' => 'required|string|max:255',
            'valid_until' => 'nullable|date',
        ]);

        $validated['vendor_id'] = $vendor->id;

        VendorCertification::create($validated);

        return redirect()->route('vendorinvoicing.create', $vendor->id)
                         ->with('success', 'Certification added successfully.');
    }

    /**
     * Display the specified certification.
     */
    public function show($vendorId, $certificationId)
    {
        $certification = VendorCertification::where('vendor_id', $vendorId)->findOrFail($certificationId);
        return view('Vendor.VendorCertification.show', compact('certification'));
    }

    /**
     * Show the form for editing the specified certification.
     */
    public function edit($vendorId, $certificationId)
    {
        $certification = VendorCertification::where('vendor_id', $vendorId)->findOrFail($certificationId);
        return view('Vendor.VendorCertification.edit', compact('certification'));
    }

    /**
     * Update the specified certification in storage.
     */
    public function update(Request $request, $vendorId, $certificationId)
    {
        $certification = VendorCertification::where('vendor_id', $vendorId)->findOrFail($certificationId);

        $validated = $request->validate([
            'certification_name' => 'required|string|max:255',
            'certification_type' => 'required|in:Business License,Safety Certification,Insurance Document,Other',
            'file_path' => 'required|string|max:255',
            'valid_until' => 'nullable|date',
        ]);

        $certification->update($validated);

        return redirect()->route('vendorcertification.index', $vendorId)
                         ->with('success', 'Certification updated successfully.');
    }

    /**
     * Remove the specified certification from storage.
     */
    public function destroy($vendorId, $certificationId)
    {
        $certification = VendorCertification::where('vendor_id', $vendorId)->findOrFail($certificationId);
        $certification->delete();

        return redirect()->route('vendorcertification.index', $vendorId)
                         ->with('success', 'Certification deleted successfully.');
    }
}
