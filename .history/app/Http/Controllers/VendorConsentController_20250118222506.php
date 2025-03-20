<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorConsent;
use Illuminate\Http\Request;

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
    public function create($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
        return view('Vendor.VendorConsent.create', compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $vendorId)
    {
        // Ensure the vendor exists
        $vendor = Vendor::findOrFail($vendorId);
        
        \Log::info('Vendor found: ', ['vendor_id' => $vendor->id]);
    
        // Validate the form inputs
        $validated = $request->validate([
            'authorized_person_name' => 'required|string|max:255',
            'contract_email' => 'required|email|max:255',
            'agreement_to_terms' => 'required|in:Yes,No',
            'agreement_to_credit_check' => 'required|in:Yes,No',
            'signature' => 'required|string',
        ]);
    
        // Log the validated data to check what is being sent
        \Log::info('Validated data:', $validated);
    
        // Add the vendor_id to the validated data
        $validated['vendor_id'] = $vendor->id;
    
        try {
            // Try to create the VendorConsent record
            VendorConsent::create($validated);
    
            \Log::info('Vendor consent created successfully:', ['vendor_id' => $vendor->id]);
    
            // Redirect with success
            return redirect()->route('vendorcertification.create', ['vendor' => $vendorId])
                ->with('success', 'Vendor consent record created successfully. Proceed to vendor certification.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error storing vendor consent: ' . $e->getMessage(), [
                'vendor_id' => $vendor->id,
                'error' => $e->getMessage()
            ]);
    
            // Return with error
            return back()->withErrors('An error occurred while saving the vendor consent. Please try again.');
        }
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

        try {
            $consent = VendorConsent::findOrFail($id);
            $consent->update($validatedData);

            return redirect()->route('vendorconsent.index')->with('success', 'Vendor consent record updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating vendor consent: ' . $e->getMessage());

            return back()->withErrors('An error occurred while updating the vendor consent. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $consent = VendorConsent::findOrFail($id);
            $consent->delete();

            return redirect()->route('vendorconsent.index')->with('success', 'Vendor consent record deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting vendor consent: ' . $e->getMessage());

            return back()->withErrors('An error occurred while deleting the vendor consent. Please try again.');
        }
    }
}
