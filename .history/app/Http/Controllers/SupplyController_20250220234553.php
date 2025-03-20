<?php

namespace App\Http\Controllers;

use App\Events\SupplyStockChanged;
use App\Models\Supply;
use App\Models\SupplyReport;
use App\Events\StockUpdated;
use Illuminate\Http\Request;
use Log;

class SupplyController extends Controller
{
    // Display all supplies
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

    // Store a new supply
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

        $status = in_array($request->status, ['Pending', 'Approved', 'Rejected']) ? $request->status : 'Pending';

        // Create supply record
        $supply = Supply::create($request->all());

        // Track stock change
        $quantityChanged = $supply->stock_on_hand;

        // Dispatch stock update event
        event(new SupplyStockChanged($supply, $supply->stock_on_hand, 'increase'));


        // Create supply report
        $this->createSupplyReport($supply, $quantityChanged);

        return redirect()->route('supply.index')->with('success', 'Supply added successfully.');
    }

    // Show form to edit a supply
    public function edit(Supply $supply)
    {
        return view('Audit.Supply.edit', compact('supply'));
    }

    // Update an existing supply
// Update an existing supply
    public function update(Request $request, Supply $supply)
    {
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

       // Ensure the status is valid; default to 'Pending' if invalid
    $validStatuses = ['Pending', 'Approved', 'Rejected'];
    $status = in_array($request->status, $validStatuses) ? $request->status : 'Pending';

        // Calculate stock change
        $quantityChanged = $validated['stock_on_hand'] - $supply->stock_on_hand;

        // Update supply
       // Update the supply record
       $supply->update([
        'status' => $status,
        'description' => $request->description,
        'stock_on_hand' => $validated['stock_on_hand'],
        'remaining_stock' => $validated['remaining_stock'], // Adjust as needed
    ]);
    

        // Dispatch event only if stock changed
        if ($quantityChanged !== 0) {
            event(new SupplyStockChanged($supply, $quantityChanged, $quantityChanged > 0 ? 'increase' : 'decrease'));
        }

        // Log the update
        Log::info("Supply updated: {$supply->supply_name}, Changed by: {$quantityChanged} units, User: " . auth()->user()->name);

        // Create a supply report if stock changed
        if ($quantityChanged !== 0) {
            $supply->supplyReports()->create([
                'report_title' => 'Stock Adjustment',
                'description' => "Stock for '{$supply->supply_name}' was adjusted by {$quantityChanged} units.",
                'status' => 'Pending Review',
                'document_status' => 'Pending',
                'submitted_at' => now(),
            ]);
        }

        // Log low stock warning
        if ($supply->stock_on_hand <= $supply->reorder_level) {
            Log::warning("Low stock warning: {$supply->supply_name} only has {$supply->stock_on_hand} units left!");

            $supply->supplyReports()->create([
                'report_title' => 'Low Stock Warning',
                'description' => "Warning: Supply '{$supply->supply_name}' is low with only {$supply->stock_on_hand} left.",
                'status' => 'Pending Review',
                'document_status' => 'Pending',
                'submitted_at' => now(),
            ]);
        }

        return redirect()->route('supply.index')->with('success', 'Supply updated successfully.');
    }



    // Display a single supply
    public function show(Supply $supply)
    {
        return view('Audit.Supply.show', compact('supply'));
    }

    // Delete a supply
    public function destroy(Supply $supply)
    {
        $supply->delete();
        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }

    // Create a supply report
    protected function createSupplyReport(Supply $supply, int $quantityChanged)
    {
        if ($quantityChanged > 0) {
            $supply->supplyReports()->create([
                'report_title' => 'Stock Added',
                'description' => "New stock of '{$supply->supply_name}' added.",
                'status' => 'Pending',
                'location' => $supply->storage_location,
                'report_date' => now(),
            ]);
        } elseif ($quantityChanged < 0) {
            $supply->supplyReports()->create([
                'report_title' => 'Stock Decreased',
                'description' => "Stock of '{$supply->supply_name}' decreased by " . abs($quantityChanged) . " units.",
                'status' => 'Pending',
                'location' => $supply->storage_location,
                'report_date' => now(),
            ]);
        }
    }
}
