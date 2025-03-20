<?php


namespace App\Http\Controllers;

use App\Models\SupplierFinancialHealth;
use Illuminate\Http\Request;

class SupplierFinancialHealthController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $financialhealth = SupplierFinancialHealth::all();
        return view('Supplier.FinancialHealth.index', compact('financialHealth'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('Supplier.FinancialHealth.create');
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

        return redirect()->route('FinancialHealth.index')->with('success', 'Financial Health added successfully.');
    }

    // Display the specified resource.
    public function show(SupplierFinancialHealth $supplierFinancialHealth)
    {
        return view('Supplier.FinancialHealth.show', compact('supplierFinancialHealth'));
    }

    // Show the form for editing the specified resource.
    public function edit(SupplierFinancialHealth $supplierFinancialHealth)
    {
        return view('Supplier.FinancialHealth.edit', compact('supplierFinancialHealth'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, SupplierFinancialHealth $supplierFinancialHealth)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'bank_account_number' => 'required|string',
            'tax_compliance' => 'nullable|string',
            'insurance_coverage' => 'nullable|string',
        ]);

        $supplierFinancialHealth->update($validated);

        return redirect()->route('FinancialHealth.index')->with('success', 'Financial Health updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(SupplierFinancialHealth $supplierFinancialHealth)
    {
        $supplierFinancialHealth->delete();

        return redirect()->route('FinancialHealth.index')->with('success', 'Financial Health record deleted successfully.');
    }
}
