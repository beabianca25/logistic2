<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AuditReport;
use Illuminate\Http\Request;
use App\Events\StockUpdated;

class AssetController extends Controller
{
    public function index() {
        $assets = Asset::all();
        return view('Audit.Asset.index', compact('assets'));
    }

    public function create() {
        return view('Audit.Asset.create');
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

        $asset = Asset::create($request->all());

        // Trigger the event to update the audit report
        event(new StockUpdated($asset));

        return redirect()->route('asset.index')->with('success', 'Asset created successfully.');
    }

    public function edit(Asset $asset) {
        return view('Audit.Asset.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset) {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_category' => 'required|string|max:255',
            'asset_tag' => 'required|string|max:255|unique:assets,asset_tag,' . $asset->id,
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

        $asset->update($request->all());

        // Trigger the event to update the audit report
        event(new StockUpdated($asset));

        return redirect()->route('asset.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset) {
        $asset->delete();
        return redirect()->route('asset.index')->with('success', 'Asset deleted successfully.');
    }
}
