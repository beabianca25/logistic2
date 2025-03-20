<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;

class SupplyController extends Controller
{
    // Display the list of supplies
    public function index()
    {
        $supplies = Supply::all();
        return view('Audit.Supply.index', compact('supplies'));
    }

    // Show the form for creating a new supply
    public function create()
    {
        return view('Audit.Supply.create');
    }

    // Store a newly created supply in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supply_name' => 'required|string|max:255',
            'stock_on_hand' => 'required|integer',
            'remaining_stock' => 'required|integer',
            'reorder_level' => 'required|integer',
        ]);

        Supply::create($validated);
        return redirect()->route('supply.index')->with('success', 'Supply added successfully.');
    }

    // Display a specific supply
    public function show(Supply $supply)
    {
        return view('Audit.Supply.show', compact('supply'));
    }

    // Show the form for editing a specific supply
    public function edit(Supply $supply)
    {
        return view('Audit.Supply.edit', compact('supply'));
    }

    // Update a specific supply in the database
    public function update(Request $request, Supply $supply)
    {
        $validated = $request->validate([
            'stock_on_hand' => 'required|integer',
        ]);

        // Calculate stock difference
        $quantityChanged = $validated['stock_on_hand'] - $supply->stock_on_hand;

        // Update the remaining stock dynamically
        $supply->remaining_stock = max(0, $supply->remaining_stock + $quantityChanged);
        $supply->stock_on_hand = $validated['stock_on_hand'];

        $supply->save();

        return response()->json(['remaining_stock' => $supply->remaining_stock, 'message' => 'Stock updated successfully.']);
    }

    // Delete a specific supply
    public function destroy(Supply $supply)
    {
        $supply->delete();
        return redirect()->route('supply.index')->with('success', 'Supply deleted successfully.');
    }
}
