<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SupplierReference;
use Illuminate\Http\Request;

class SupplierReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplierreferences = SupplierReference::all();
        return view ('Supplier.SupplierReference.index', compact('supplierreferences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('Supplier.SupplierReference.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
