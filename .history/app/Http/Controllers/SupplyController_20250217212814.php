<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\AuditReport;
use Illuminate\Http\Request;
use App\Events\StockUpdated;

class SupplyController extends Controller
{
    public function index() {
        $supplies = Supply::all();
        return view('Audit.Supply.index', compact('supplies'));
    }

    public function create() {
        return view('Audit.Supply.create');
    }

    public function store(Request $request) {
        $request->validate([
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

        $supply = Supply::create($request->all());

        // Trigger the event to update the audit report
        event(new StockUpdated($supply));

        return redirect()->route('supply.index')->with('success', 'Supply created successfully.');
    }

    public function edit(Supply $supply) {
        return view('Audit.Supply.edit', compact('supply'));
    }

    public function update(Request $request, Supply $supply) {
        $request->validate([
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

        $supply->update($request->all());

        // Trigger the event to update the audit report
        event(new StockUpdated($supply));

        return redirect()->route('supply.index')->with('success', 'Supply updated successfully.');
    }

    public function destroy(Supply $supply) {
        $supply->delete();
        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }
}
