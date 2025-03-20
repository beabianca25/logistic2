<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapv;

class MapVController extends Controller
{
    // Display a listing of the resources
    public function index()
    {
        $mapvs = Mapv::all(); // Retrieve all mapv records
        return view('mapv.index', compact('mapvs'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('mapv.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'nullable|string|max:255',
        ]);

        Mapv::create($validated);

        return redirect()->route('mapv.index')->with('success', 'Mapv created successfully.');
    }

    // Display the specified resource
    public function show($id)
    {
        $mapv = Mapv::findOrFail($id);
        return view('mapv.show', compact('mapv'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $mapv = Mapv::findOrFail($id);
        return view('mapv.edit', compact('mapv'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $mapv = Mapv::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'nullable|string|max:255',
        ]);

        $mapv->update($validated);

        return redirect()->route('mapv.index')->with('success', 'Mapv updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $mapv = Mapv::findOrFail($id);
        $mapv->delete();

        return redirect()->route('mapv.index')->with('success', 'Mapv deleted successfully.');
    }
}
