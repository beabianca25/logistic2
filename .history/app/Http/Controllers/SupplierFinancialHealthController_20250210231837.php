<?php


namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierFinancialHealth;
use Illuminate\Http\Request;

class SupplierFinancialHealthController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $financialhealths = SupplierFinancialHealth::all();
        $suppliers = Supplier::all();
        return view('Supplier.FinancialHealth.index', compact('financialhealths', 'suppliers'));
    }

    // Show the form for creating a new resource.
    public function create($supplier_id)
    {
        // Fetch the supplier using the supplier_id from the route
        $supplier = Supplier::findOrFail($supplier_id);

        // Pass the supplier data to the view
        return view('Supplier.FinancialHealth.create', compact('supplier'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'bank_account_number' => 'required|string',
            'tax_compliance' => 'nullable|string',
            'insurance_coverage' => 'nullable|string',
        ]);
    
        SupplierFinancialHealth::create($validated);
    
        // Use the supplier_id from the validated data
        return redirect()->route('supplierreference.create', ['supplier_id' => $validated['supplier_id']]);
    }
    
    // Display the specified resource.
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        $financialhealth = SupplierFinancialHealth::where('supplier_id', $id)->get(); // or first() if expecting one record
    
        return view('Supplier.Supplier.show', compact('supplier', 'financialhealth'));
    }
    
    

    // Show the form for editing the specified resource.
    public function edit(SupplierFinancialHealth $financialhealth)
    {
        return view('Supplier.FinancialHealth.edit', compact('supplierFinancialHealth'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, SupplierFinancialHealth $financialhealth)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'bank_account_number' => 'required|string',
            'tax_compliance' => 'nullable|string',
            'insurance_coverage' => 'nullable|string',
        ]);

        $financialhealth ->update($validated);

        return redirect()->route('FinancialHealth.index')->with('success', 'Financial Health updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(SupplierFinancialHealth $financialhealth)
    {
        $financialhealth->delete();

        return redirect()->route('FinancialHealth.index')->with('success', 'Financial Health record deleted successfully.');
    }
}
