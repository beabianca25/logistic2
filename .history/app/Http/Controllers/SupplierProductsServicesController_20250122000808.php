<?php
namespace App\Http\Controllers;

use App\Models\SupplierProductsServices;
use Illuminate\Http\Request;

class SupplierProductsServicesController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $productsServices = SupplierProductsServices::all();
        return view('supplier_products_services.index', compact('productsServices'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('supplier_products_services.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string',
            'minimum_order' => 'nullable|string',
        ]);

        SupplierProductsServices::create($validated);

        return redirect()->route('supplier_products_services.index')->with('success', 'Product/Service added successfully.');
    }

    // Display the specified resource.
    public function show(SupplierProductsServices $supplierProductsService)
    {
        return view('supplier_products_services.show', compact('supplierProductsService'));
    }

    // Show the form for editing the specified resource.
    public function edit(SupplierProductsServices $supplierProductsService)
    {
        return view('supplier_products_services.edit', compact('supplierProductsService'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, SupplierProductsServices $supplierProductsService)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string',
            'minimum_order' => 'nullable|string',
        ]);

        $supplierProductsService->update($validated);

        return redirect()->route('supplier_products_services.index')->with('success', 'Product/Service updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(SupplierProductsServices $supplierProductsService)
    {
        $supplierProductsService->delete();

        return redirect()->route('supplier_products_services.index')->with('success', 'Product/Service deleted successfully.');
    }
}