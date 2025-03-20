<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\SupplyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplyController extends Controller
{
    // Show all supplies
    public function index()
    {
        $supplies = Supply::all();
        return view('Audit.Supply.index', compact('supplies'));
    }

    // Show form to create a new supply
    public function create()
    {
        return view('Audit.Supply.create');
    }

    // Store a newly created supply in the database
    public function store(Request $request)
    {
        $request->validate([
            'supply_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'supplier_vendor' => 'required|string|max:255',
            'quantity_purchased' => 'required|integer|min:1',
            'unit_of_measurement' => 'required|string|max:50',
            'stock_on_hand' => 'required|integer|min:0',
            'remaining_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'invoice_receipt_number' => 'nullable|string|max:255',
            'issued_to' => 'nullable|string|max:255',
            'date_issued' => 'nullable|date',
            'purpose_usage' => 'nullable|string',
            'storage_location' => 'nullable|string|max:255',
            'condition' => 'nullable|string|max:50',
            'expiration_date' => 'nullable|date',
            'maintenance_schedule' => 'nullable|string|max:255',
        ]);

        Supply::create($request->all());

        return redirect()->route('supply.index')->with('success', 'Supply created successfully.');
    }

    // Show the details of a single supply
    public function show(Supply $supply)
    {
        return view('Audit.Supply.show', compact('supply'));
    }

    // Show form to edit an existing supply
    public function edit(Supply $supply)
    {
        return view('Audit.Supply.edit', compact('supply'));
    }

    // Update an existing supply
    public function update(Request $request, Supply $supply)
    {
        $request->validate([
            'remaining_stock' => 'required|integer|min:0',
        ]);
    
        // Update stock
        $supply->update(['remaining_stock' => $request->remaining_stock]);
    
        // Check if stock is below reorder level
        if ($supply->remaining_stock <= $supply->reorder_level) {
            // Check if an existing report exists
            $existingReport = SupplyReport::where('supply_id', $supply->id)
                ->where('status', 'Pending Review')
                ->first();
    
            if ($existingReport) {
                // Update existing report instead of creating a new one
                $existingReport->update([
                    'report_details' => "Supply '{$supply->supply_name}' (ID: {$supply->id}) is low with only {$supply->remaining_stock} left.",
                    'submitted_at' => now(),
                ]);
            } else {
                // Create a new audit report if none exists
                SupplyReport::create([
                    'supply_id' => $supply->id,
                    'report_title' => 'Low Supply Stock Warning',
                    'report_details' => "Supply '{$supply->supply_name}' (ID: {$supply->id}) is low with only {$supply->remaining_stock} left.",
                    'status' => 'Pending Review',
                    'document_status' => 'Pending',
                    'submitted_at' => now(),
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Stock updated successfully.');
    }
    

    // Delete a supply
    public function destroy(Supply $supply)
    {
        // Ensure supply can be deleted safely (optional: check if it has related reports)
        $relatedReports = SupplyReport::where('supply_id', $supply->id)->exists();

        if ($relatedReports) {
            return redirect()->route('supply.index')->with('error', 'Cannot delete supply with existing audit reports.');
        }

        $supply->delete();

        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }
}
