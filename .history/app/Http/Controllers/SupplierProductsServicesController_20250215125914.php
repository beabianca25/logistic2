<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierProductServices;
use Illuminate\Http\Request;

class SupplierProductsServicesController extends Controller
{
    public function index()
    {
        $productservices = SupplierProductServices::all();
        $suppliers = Supplier::all();
        return view('Supplier.ProductService.index', compact('productservices', 'suppliers'));
    }

    public function create(Request $request)
    {
        $supplier = Supplier::findOrFail($request->supplier_id);
        return view('Supplier.ProductService.create', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string|max:255',
            'minimum_order' => 'nullable|numeric',
        ]);

        SupplierProductServices::create($request->all());

        return redirect()->route('productservice.index')->with('success', 'Product/Service created successfully.');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        
        // Check if productservices are being retrieved
        $productservices = SupplierProductServices::where('supplier_id', $id)->get(); 
    
        return view('Supplier.Supplier.show', compact('supplier', 'productservices'));
    }
    
    public function edit($id)
    {
        $productservice = SupplierProductServices::findOrFail($id);
        return view('Supplier.ProductService.edit', compact('productservice'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string|max:255',
            'minimum_order' => 'nullable|numeric',
        ]);

        $productService = SupplierProductServices::findOrFail($id);
        $productService->update($request->all());

        return redirect()->route('financialhealth.create')->with('success', 'Product/Service updated successfully.');
    }

    public function destroy($id)
    {
        $productservice = SupplierProductServices::findOrFail($id);
        $productservice->delete();

        return redirect()->route('productservice.index')->with('success', 'Product/Service deleted successfully.');
    }
}
