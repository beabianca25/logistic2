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

        // Ensure audit report is created properly
        AssetReport::create([
            'report_title' => 'New Asset Created',
            'status' => 'Created',
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
            'usage_status' => 'required|in:Active,Under Maintenance,Retired',
            'location' => 'nullable|string',
        ]);
    
        // Log old and new status
        Log::info("Updating Asset ID: {$asset->id}, Old Status: {$asset->usage_status}, New Status: {$request->usage_status}");
    
        $asset->update($request->only(['usage_status', 'location']));
    
        // Check if asset is under maintenance or retired
        if ($request->usage_status === 'Under Maintenance' || $request->usage_status === 'Retired') {
            Log::info("Asset ID: {$asset->id} is now {$request->usage_status}");
    
            $existingReport = AssetReport::where('asset_id', $asset->id)
            ->where('status', 'Pending Review')
            ->first();
        
        if ($existingReport) {
            Log::info("Updating existing AssetReport for Asset ID: {$asset->id}");
        
            $existingReport->update([
                'report_title' => 'Asset Status Update',
                'report_details' => "Asset '{$asset->asset_name}' (ID: {$asset->id}) is now marked as {$request->usage_status}.",
                'status' => 'Pending Review',
                'document_status' => 'Pending',
                'submitted_at' => now(),
            ]);
        } else {
            Log::info("Creating new AssetReport for Asset ID: {$asset->id}");
        
            AssetReport::create([
                'asset_id' => $asset->id,
                'report_title' => 'Asset Status Update', // ✅ Ensure this is always set
                'report_details' => "Asset '{$asset->asset_name}' (ID: {$asset->id}) is now marked as {$request->usage_status}.",
                'status' => 'Pending Review',
                'document_status' => 'Pending',
                'submitted_at' => now(),
            ]);
        }
        
        } else {
            Log::info("Asset status is normal, no report needed for Asset ID: {$asset->id}");
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
