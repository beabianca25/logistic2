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
        $productservices = SupplierProductServices::all();
        return view('Supplier.ProductService.index', compact('productservices'));
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
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string',
            'minimum_order' => 'nullable|string',
        ]);
    
        // Debug before creating the entry in the database
        dd(SupplierProductServices::create($validated));
    
        return redirect()->route('financialhealth.create')->with('success', 'Product/Service added successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(SupplierProductServices $productservice)
    {
        return view('Supplier.ProductService.show', compact('productservice'));
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
    public function update(Request $request, SupplierProductServices $productservice)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'lead_time' => 'required|string',
            'minimum_order' => 'nullable|string',
        ]);

        $productservice->update($validated);

        return redirect()->route('ProductService.index')->with('success', 'Product/Service updated successfully.');
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
