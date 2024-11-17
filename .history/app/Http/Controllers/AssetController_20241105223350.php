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
        return view('audit.assets.index', compact('assets'));
    }

    // Show the form for creating a new asset
    public function create()
    {
        return view('audit.assets.create');
    }

    // Store a newly created asset in the database
    public function store(Request $request)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'acquisition_date' => 'required|date',
        ]);

        Asset::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    // Display the specified asset
    public function show(Asset $asset)
    {
        return view('audit.assets.show', compact('asset'));
    }

    // Show the form for editing the specified asset
    public function edit(Asset $asset)
    {
        return view('audit.assets.edit', compact('asset'));
    }

    // Update the specified asset in the database
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'acquisition_date' => 'required|date',
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
