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
    public function update(Request $request, Supply $supply)
    {

        dd($request->all());  // This will show all data submitted in the form

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
            'remaining_stock' => 'required|integer|min:0',  // Ensure this is validated
        ]);
    
        // Get the updated remaining stock from the request
        $remainingStock = $request->input('remaining_stock');
    
        // Calculate the change in stock
        $quantityChanged = $remainingStock - $supply->remaining_stock;
    
        // Update the supply with validated data
        $supply->update($validated);
    
        // Update the remaining stock field
        $supply->remaining_stock = $remainingStock;
        $supply->save();
    
        // Create a new audit report entry for this stock update
        AuditReport::create([
            'supply_id' => $supply->id,
            'action' => 'Updated Remaining Stock',
            'quantity_changed' => $quantityChanged, // Log the change in stock
            'date' => now(),
        ]);
    
        // Redirect with success message
        return redirect()->route('supply.index')->with('success', 'Supply updated successfully.');
    }
    
    
    // Remove the specified supply from the database
    public function destroy(Supply $supply) {
        // Delete the supply
        $supply->delete();

        // Redirect with success message
        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }
}
