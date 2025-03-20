<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetReport;
use Illuminate\Http\Request;
use App\Events\AssetStockUpdated;
use Log;

class AssetController extends Controller
{
    // Display all assets
    public function index() {
        $assets = Asset::all();
        return view('Audit.Assets.index', compact('assets'));
    }

    // Show create asset form
    public function create() {
        return view('Audit.Assets.create');
    }

    // Store new asset
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

        AssetReport::create([
            'asset_id' => $asset->id, // Ensure this is included
            'report_title' => 'New Asset Created',
            'report_details' => "Asset '{$asset->asset_name}' (ID: {$asset->id}) was added to the system.",
            'status' => 'Created',
            'document_status' => 'Pending',
            'submitted_at' => now(),
        ]);
        

        // Trigger asset stock update event
        event(new AssetStockUpdated($asset));

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    // Show edit form for asset
    public function edit(Asset $asset) {
        return view('Audit.Assets.edit', compact('asset'));
    }

    // Update asset
    public function update(Request $request, $id) {
        $asset = Asset::findOrFail($id);
    
        $request->validate([
            'usage_status' => 'required|in:Active,Under Maintenance,Retired,Disposed',
            'location' => 'nullable|string',
        ]);
    
        // Log old and new status
        Log::info("Updating Asset ID: {$asset->id}, Old Status: {$asset->usage_status}, New Status: {$request->usage_status}");
    
        $asset->update($request->only(['usage_status', 'location']));
    
        // ✅ 1️⃣ Handling Under Maintenance & Retired (Existing Code)
        if ($request->usage_status === 'Under Maintenance' || $request->usage_status === 'Retired') {
            Log::info("Asset ID: {$asset->id} is now {$request->usage_status}");
    
            AssetReport::updateOrCreate(
                ['asset_id' => $asset->id, 'status' => 'Pending Review'],
                [
                    'report_title' => 'Asset Status Update',
                    'report_details' => "Asset '{$asset->asset_name}' (ID: {$asset->id}) is now marked as {$request->usage_status}.",
                    'status' => 'Pending Review',
                    'document_status' => 'Pending',
                    'submitted_at' => now(),
                ]
            );
        }
    
        // ✅ 2️⃣ Handling Warranty Expiry
        if ($asset->warranty_expiry_date && now()->gt($asset->warranty_expiry_date)) {
            Log::info("Asset ID: {$asset->id} Warranty has expired");
    
            AssetReport::updateOrCreate(
                ['asset_id' => $asset->id, 'report_type' => 'Warranty Expiry'],
                [
                    'report_title' => 'Warranty Expiry Alert',
                    'report_details' => "Asset '{$asset->asset_name}' (ID: {$asset->id}) warranty expired on {$asset->warranty_expiry_date}.",
                    'status' => 'Pending Review',
                    'document_status' => 'Pending',
                    'submitted_at' => now(),
                ]
            );
        }
    
        // ✅ 3️⃣ Handling Disposal
        if ($request->usage_status === 'Disposed') {
            Log::info("Asset ID: {$asset->id} has been disposed");
    
            AssetReport::create([
                'asset_id' => $asset->id,
                'report_title' => 'Asset Disposal',
                'report_details' => "Asset '{$asset->asset_name}' (ID: {$asset->id}) has been disposed.",
                'status' => 'Pending Review',
                'document_status' => 'Pending',
                'submitted_at' => now(),
            ]);
        }
    
        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }
    
    

    // Show asset details
    public function show(Asset $asset) {
        return view('Audit.Assets.show', compact('asset'));
    }

    // Delete asset
    public function destroy(Asset $asset) {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
