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

        return view('Vendor.VendorService.create', compact('vendor'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Vendor $vendor)
    {
        // Validate incoming request
        $validated = $request->validate([
            'service_category' => 'required',
            'service_description' => 'required',
            'areas_of_operation' => 'required',
            'price_range' => 'nullable|string',
        ]);
    
        // Store vendor service logic
        $vendorService = new VendorService();
        $vendorService->vendor_id = $vendor->id;
        $vendorService->service_category = $validated['service_category'];
        $vendorService->service_description = $validated['service_description'];
        $vendorService->areas_of_operation = $validated['areas_of_operation'];
        $vendorService->price_range = $validated['price_range'];
        $vendorService->save();
    
        return redirect()->route('vendorservice.index')->with('success', 'Vendor Service created successfully!');
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
