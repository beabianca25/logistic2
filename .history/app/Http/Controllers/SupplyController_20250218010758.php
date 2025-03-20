<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\AuditReport;  // Import the AuditReport model
use App\Events\StockUpdated;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    // Display a listing of the supplies
    public function index() {
        $supplies = Supply::all();
        return view('Audit.Supply.index', compact('supplies'));
    }

    // Show the form for creating a new supply
    public function create() {
        return view('Audit.Supply.create');
    }

    // Store a newly created supply in the database
    public function store(Request $request)
    {
        $request->validate([
            'supply_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'supplier_vendor' => 'required|string|max:255',
            'quantity_purchased' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'unit_of_measurement' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'stock_on_hand' => 'required|numeric',
            'reorder_level' => 'required|numeric',
            'storage_location' => 'nullable|string|max:255',
        ]);

        // Create the supply record
        $supply = Supply::create($request->all());

        // Dispatch the event to notify about the stock update
        event(new StockUpdated(null, $supply));

        return redirect()->route('supply.index')->with('success', 'Supply created successfully.');
    }

    // Show the form for editing the specified supply
    public function edit(Supply $supply) {
        return view('Audit.Supply.edit', compact('supply'));
    }

    // Update the specified supply in the database
    // Update the specified supply in the database
    public function update(Request $request, Supply $supply)
    {
        // Validate the data
        $validated = $request->validate([
            'supply_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'supplier_vendor' => 'required|string|max:255',
            'quantity_purchased' => 'required|integer',
            'unit_of_measurement' => 'required|string|max:50',
            'stock_on_hand' => 'required|integer',
            'unit_price' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'purchase_date' => 'required|date',
            'reorder_level' => 'required|integer',
            'storage_location' => 'nullable|string|max:255',
        ]);
    
        // Calculate the difference in stock
        $stockDifference = $supply->stock_on_hand - $request->stock_on_hand;
    
        // Update the stock_on_hand and adjust remaining_stock
        $supply->stock_on_hand = $request->stock_on_hand;
    
        // Decrease remaining stock based on stock difference
        $supply->remaining_stock -= $stockDifference;
    
        // Save the updated supply
        $supply->save();
    
        // If remaining stock is updated, create an audit report
        AuditReport::create([
            'supply_id' => $supply->id,
            'action' => 'Updated Remaining Stock',
            'quantity_changed' => -$stockDifference,
            'date' => now(),
        ]);
    
        return redirect()->route('supply.index')->with('success', 'Supply updated successfully.');
    }
    


    public function show(Supply $supply) {
        return view('Audit.Supply.show', compact('supply'));
    }
    
    
    // Remove the specified supply from the database
    public function destroy(Supply $supply) {
        // Delete the supply
        $supply->delete();

        // Redirect with success message
        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }
}
