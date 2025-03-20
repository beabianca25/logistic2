<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\AuditReport;
use Illuminate\Http\Request;
use App\Events\StockUpdated;

class SupplyController extends Controller
{
    /**
     * Display a listing of the supplies.
     */
    public function index() {
        $supplies = Supply::all();
        return view('Audit.Supply.index', compact('supplies'));
    }

    /**
     * Show the form for creating a new supply.
     */
    public function create() {
        return view('Audit.Supply.create');
    }

    /**
     * Store a newly created supply in the database.
     */
    public function store(Request $request) {
        // Validate input
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
        ]);

        // Create the supply
        $supply = Supply::create($validated);

        // Trigger event to update the audit report
        event(new StockUpdated($supply));

        // Redirect with success message
        return redirect()->route('supply.index')->with('success', 'Supply created successfully.');
    }

    /**
     * Show the form for editing the specified supply.
     */
    public function edit(Supply $supply) {
        return view('Audit.Supply.edit', compact('supply'));
    }

    /**
     * Update the specified supply in the database.
     */
    public function update(Request $request, Supply $supply) {
        // Validate input
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
        ]);

        // Update the supply
        $supply->update($validated);

        // Trigger event to update the audit report
        event(new StockUpdated($supply));

        // Redirect with success message
        return redirect()->route('supply.index')->with('success', 'Supply updated successfully.');
    }

    /**
     * Remove the specified supply from the database.
     */
    public function destroy(Supply $supply) {
        // Delete the supply
        $supply->delete();

        // Redirect with success message
        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }
}
