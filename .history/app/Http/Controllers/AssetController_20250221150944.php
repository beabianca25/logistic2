<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Events\AssetStockUpdated;

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

        $asset = Asset::create($request->all());

        // Trigger event for asset stock update
        event(new AssetStockUpdated($asset));

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    public function edit(Asset $asset) {
        return view('Audit.Assets.edit', compact('asset'));
    }

    public function update(Request $request, $id) {
        $asset = Asset::findOrFail($id);

        $request->validate([
            'usage_status' => 'required|in:Active,Under Maintenance,Retired',
            'location' => 'nullable|string',
        ]);

        $asset->update($request->only(['usage_status', 'location']));

        // Trigger event for asset stock update
        event(new AssetStockUpdated($asset));

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }

    public function show(Asset $asset) {
        return view('Audit.Assets.show', compact('asset'));
    }

    public function destroy(Asset $asset) {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
