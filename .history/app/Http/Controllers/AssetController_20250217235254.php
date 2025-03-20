<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AuditReport;
use App\Models\Supply;
use Illuminate\Http\Request;
use App\Events\StockUpdated;

class AssetController extends Controller
{
    public function index() {
        $assets = Asset::all();
        return view('Audit.Assets.index', compact('assets'));
    }

    public function create() {
        return view('Audit.Assets.create');
    }

    public function store(Request $request) {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_category' => 'required|string|max:255',
            'asset_tag' => 'required|string|max:255|unique:assets',
            'description' => 'nullable|string',
            'purchase_date' => 'required|date',
            'supplier_vendor' => 'required|string|max:255',
            'cost_of_asset' => 'required|numeric',
            'assigned_to' => 'nullable|string',
            'location' => 'nullable|string',
            'usage_status' => 'required|in:Active,Under Maintenance,Retired',
            'warranty_expiry_date' => 'nullable|date',
            'maintenance_schedule' => 'nullable|string',
        ]);

        // Create the asset
        $asset = Asset::create($request->all());

        // Trigger the event to update the audit report for asset stock
        event(new StockUpdated($asset)); // No supply here, only asset

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    public function edit(Asset $asset) {
        return view('Audit.Assets.edit', compact('asset'));
    }

    public function update(Request $request, $id)
    {
        // Find the asset by ID
        $asset = Asset::findOrFail($id);

        // Update asset fields (example: status, location)
        $asset->usage_status = $request->input('usage_status');
        $asset->location = $request->input('location');
        $asset->save();

        // Optionally, if you're updating a supply related to the asset, you can do so here
        $supply = null;
        if ($request->has('supply_id')) {
            $supply = Supply::find($request->input('supply_id'));
            if ($supply) {
                // Update supply fields (e.g., stock levels)
                $supply->remaining_stock = $request->input('remaining_stock');
                $supply->save();
            }
        }

        // Dispatch the event for asset and (optionally) supply update
        event(new StockUpdated($asset, $supply));

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }

    public function show(Asset $asset)
    {
        return view('Audit.Assets.show', compact('asset'));
    }

    public function destroy(Asset $asset) {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
