<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierProductServices;
use Illuminate\Http\Request;

class SupplierProductsServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsservices = SupplierProductServices::all();
        $suppliers = Supplier::all();
        return view('Supplier.ProductService.index', compact('productsservices', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($supplier_id)
    {
        $supplier = Supplier::findOrFail($supplier_id);
        return view('Supplier.ProductService.create', compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',  // Ensure supplier exists
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',  // Price can be nullable but should be numeric
            'lead_time' => 'required|string|max:255',  // Lead time should be a string
            'minimum_order' => 'nullable|numeric',  // Minimum order should be numeric if provided
        ]);

        // Create a new product/service entry
        SupplierProductServices::create([
            'supplier_id' => $request->supplier_id,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'lead_time' => $request->lead_time,
            'minimum_order' => $request->minimum_order,
        ]);

        return redirect()->route('financialhealth.create', ['supplier_id' => $request->supplier_id])
        ->with('success', 'Product/Service created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $productsservice = SupplierProductServices::findOrFail($id);
        return view('Supplier.ProductService.show', compact('productsservice'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierProductServices $productservice)
    {
        return view('Supplier.ProductService.edit', compact('productservice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string|max:255',
            'minimum_order' => 'nullable|numeric',
        ]);

        // Find the product/service and update it
        $productService = SupplierProductServices::findOrFail($id);
        $productService->update([
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'lead_time' => $request->lead_time,
            'minimum_order' => $request->minimum_order,
        ]);

        // Redirect back with a success message
        return redirect()->route('productservice.index')->with('success', 'Product/Service updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierProductServices $productservice)
    {
        $productservice->delete();

        return redirect()->route('ProductService.index')->with('success', 'Product/Service deleted successfully.');
    }
}
