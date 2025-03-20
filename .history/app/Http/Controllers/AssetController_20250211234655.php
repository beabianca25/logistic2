<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    // Display a listing of assets
    public function index()
    {
        $assets = Asset::all();
        return view('Audit.Assets.index', compact('assets'));
    }

    // Show the form for creating a new asset
    public function create()
    {
        return view('Audit.Assets.create');
    }

    // Store a newly created asset in the database
    public function store(Request $request)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_category' => 'required|string|max:255',
            'asset_tag' => 'required|string|unique:assets,asset_tag',
            'purchase_date' => 'required|date',
            'supplier_vendor' => 'required|string|max:255',
            'cost_of_asset' => 'required|numeric',
        ]);

        Asset::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    // Display the specified asset
    public function show(Asset $asset)
    {
        return view('Audit.Assets.show', compact('asset'));
    }

    // Show the form for editing the specified asset
    public function edit(Asset $asset)
    {
        return view('Audit.Assets.edit', compact('asset'));
    }

    // Update the specified asset in the database
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_category' => 'required|string|max:255',
            'asset_tag' => 'required|string|unique:assets,asset_tag,' . $asset->id,
            'purchase_date' => 'required|date',
            'supplier_vendor' => 'required|string|max:255',
            'cost_of_asset' => 'required|numeric',
        ]);

        $asset->update($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    // Remove the specified asset from the database
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
