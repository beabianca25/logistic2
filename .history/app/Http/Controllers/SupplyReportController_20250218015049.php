<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use App\Models\SupplyReport;
use Illuminate\Http\Request;

class SupplyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all supply reports
        $supplyReports = SupplyReport::all();

        // Return view with supply reports
        return view('supply_reports.index', compact('supplyReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Get all supplies for the dropdown
         $supplies = Supply::all();

         return view('supply_reports.create', compact('supplies'));
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
