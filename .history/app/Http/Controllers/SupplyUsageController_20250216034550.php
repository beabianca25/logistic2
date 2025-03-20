<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use App\Models\SupplyUsage;
use Illuminate\Http\Request;

class SupplyUsageController extends Controller
{
    public function recordUsage(Request $request)
    {
        $request->validate([
            'supply_id' => 'required|exists:supplies,id',
            'issued_to' => 'required|string',
            'quantity_used' => 'required|integer|min:1',
            'usage_reason' => 'nullable|string',
        ]);

        $supply = Supply::findOrFail($request->supply_id);

        // Check if there's enough stock
        if ($supply->remaining_stock < $request->quantity_used) {
            return back()->with('error', 'Not enough supply available!');
        }

        // Record the usage
        SupplyUsage::create([
            'supply_id' => $supply->id,
            'issued_to' => $request->issued_to,
            'quantity_used' => $request->quantity_used,
            'usage_reason' => $request->usage_reason,
        ]);

        // Decrease stock
        $supply->remaining_stock -= $request->quantity_used;
        $supply->save();

        return back()->with('success', 'Supply usage recorded and stock updated!');
    }
}
