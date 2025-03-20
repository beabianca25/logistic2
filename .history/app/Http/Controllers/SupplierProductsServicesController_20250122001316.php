<?php
namespace App\Http\Controllers;

use App\Models\SupplierProductsServices;
use Illuminate\Http\Request;

class SupplierProductsServicesController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $productsservices = SupplierProductsServices::all();
        return view('Supplier.ProductService.index', compact('productsservices'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('Supplier.ProductService.create');
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

        return redirect()->route('ProductService.index')->with('success', 'Product/Service added successfully.');
    }

    // Display the specified resource.
    public function show(SupplierProductsServices $productsservice)
    {
        return view('Supplier.ProductService.show', compact('supplierProductsService'));
    }

    // Show the form for editing the specified resource.
    public function edit(SupplierProductsServices $productsservice)
    {
        return view('Supplier.ProductService.edit', compact('supplierProductsService'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, SupplierProductsServices $productsservice)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string',
            'minimum_order' => 'nullable|string',
        ]);

        $productsservice->update($validated);

        return redirect()->route('ProductService.index')->with('success', 'Product/Service updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(SupplierProductsServices $productsservice)
    {
        $productsservice->delete();

        return redirect()->route('ProductService.index')->with('success', 'Product/Service deleted successfully.');
    }
}