<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorService;

class VendorServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = VendorService::all();
        return view('Vendor.VendorService.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Vendor $vendor)
    {
        $vendor = Vendor::findOrFail($vendor);

        return view('Vendor.VendorService.create', compact('vendor'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $vendorId)
    {
        dd($vendorId);
        // Validate the form inputs
        $request->validate([
            'service_category' => 'required|string|max:255',
            'service_description' => 'required|string',
            'areas_of_operation' => 'required|string',
            'price_range' => 'nullable|string',
        ]);
    
        // Store the data
        VendorService::create([
            'vendor_id' => $vendorId,
            'service_category' => $request->input('service_category'),
            'service_description' => $request->input('service_description'),
            'areas_of_operation' => $request->input('areas_of_operation'),
            'price_range' => $request->input('price_range'),
        ]);
    
        // Redirect with success message
        return redirect()->route('vendorservice.index')->with('success', 'Vendor service created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = VendorService::findOrFail($id);
        return view('Vendor.VendorService.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = VendorService::findOrFail($id);
        return view('Vendor.VendorService.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'service_category' => 'required|in:Accommodation,Transportation,Tours & Packages,Event Planning,Catering,Other',
            'service_description' => 'required|string',
            'areas_of_operation' => 'required|string',
            'price_range' => 'nullable|string',
        ]);

        $service = VendorService::findOrFail($id);
        $service->update($validatedData);

        return redirect()->route('vendorservice.index')->with('success', 'Vendor service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = VendorService::findOrFail($id);
        $service->delete();

        return redirect()->route('vendorservice.index')->with('success', 'Vendor service deleted successfully.');
    }
}
