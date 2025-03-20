<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\AuditReport;  // Import the AuditReport model
use App\Events\StockUpdated;
use App\Models\SupplyReport;
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
    
        // Check for stock change (increase or decrease)
        $quantityChanged = $supply->stock_on_hand; // Initially, this is the stock added
        $previousStock = 0;  // Assume stock is 0 when a new supply is added
    
        // If it's an update (not a new stock), track the change
        if ($request->has('previous_stock')) {
            $previousStock = $request->previous_stock;
            $quantityChanged = $supply->stock_on_hand - $previousStock; // Calculate the difference
        }
    
        // If stock is decreased, update the remaining stock
        if ($quantityChanged < 0) {
            $this->decreaseStock($supply, $quantityChanged); // Custom method to handle stock decrease logic
        }
    
        // Dispatch the event to notify about the stock update
        event(new StockUpdated(null, $supply));
    
        // Save the update in the supply report
        $this->createSupplyReport($supply, $quantityChanged);
    
        return redirect()->route('supply.index')->with('success', 'Supply created/updated successfully.');
    }
    
    // Method to handle stock decrease logic
    protected function decreaseStock(Supply $supply, $quantityChanged)
    {
        $supply->remaining_stock += $quantityChanged;
        $supply->save();
    }
    
    // Method to create a supply report
    protected function createSupplyReport(Supply $supply, $quantityChanged)
    {
        // Check if stock is added or removed and create reports accordingly
        if ($quantityChanged > 0) {
            // Stock Added Report
            SupplyReport::create([
                'supply_id' => $supply->id,
                'report_title' => 'New Stock Added',
                'description' => 'New stock of ' . $supply->supply_name . ' has been added to the inventory.',
                'status' => 'Pending', // or set to 'Approved' if needed
                'location' => $supply->storage_location,
                'report_date' => now(),
            ]);
        } elseif ($quantityChanged < 0) {
            // Stock Decreased Report
            SupplyReport::create([
                'supply_id' => $supply->id,
                'report_title' => 'Stock Decreased',
                'description' => 'Stock of ' . $supply->supply_name . ' has been decreased by ' . abs($quantityChanged) . ' units.',
                'status' => 'Pending', // or set to 'Approved' if needed
                'location' => $supply->storage_location,
                'report_date' => now(),
            ]);
        }
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
            'remaining_stock' => 'required|integer', // Ensure this is included
        ]);
    
        // Calculate stock change
        $quantityChanged = $validated['remaining_stock'] - $supply->remaining_stock;
    
        // Update supply
        $supply->update($validated);
    
        // If remaining_stock changed, create an audit report
        if ($quantityChanged !== 0) {
            AuditReport::create([
                'supply_id' => $supply->id,
                'action' => 'Updated Remaining Stock',
                'quantity_changed' => $quantityChanged,
                'date' => now(),
            ]);
        }
    
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
