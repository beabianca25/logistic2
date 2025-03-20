<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Auth;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'superadmin') {
            // Admin can see all suppliers
            $suppliers = Supplier::all();
        } else {
            // Supplier can only see their own application
            $suppliers = Supplier::where('user_id', Auth::id())->get();
        }
    
        return view('Supplier.Supplier.index', compact('suppliers'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Supplier.Supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:15',
            'business_address' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
        ]);



        // Create the Supplier
        $supplier = Supplier::create([
            'company_name' => $validatedData['company_name'],
            'business_type' => $validatedData['business_type'],
            'contact_name' => $validatedData['contact_name'],
            'contact_email' => $validatedData['contact_email'],
            'contact_phone' => $validatedData['contact_phone'],
            'business_address' => $validatedData['business_address'],
            'website' => $validatedData['website'] ?? null,
            'status' => 'Pending', // Default value
        ]);

        // Redirect to the Legal and Compliance form with the supplier ID
        return redirect()->route('LegalCompliance.create', ['supplier_id' => $supplier->id])
            ->with('success', 'Supplier request submitted successfully. Please complete the Legal and Compliance form.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        $legalcompliance = $supplier->legalcompliance;  // HasOne relationship, no need for a loop
        $financialhealth = $supplier->financialhealth;
        $productservices = $supplier->productservices;
        $supplierreferences = $supplier->supplierreferences;
    
        return view('Supplier.Supplier.show', compact(
            'supplier',
            'legalcompliance',
            'productservices',
            'financialhealth',
            'supplierreferences'
        ));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('Supplier.Supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:15',
            'business_address' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'status' => 'required|in:Pending,Admin_Review,Manager_Approved',
        ]);


        // Update the Supplier with validated data
        $supplier->update([
            'company_name' => $validatedData['company_name'],
            'business_type' => $validatedData['business_type'],
            'contact_name' => $validatedData['contact_name'],
            'contact_email' => $validatedData['contact_email'],
            'contact_phone' => $validatedData['contact_phone'],
            'business_address' => $validatedData['business_address'],
            'website' => $validatedData['website'] ?? $supplier->website, // Preserve existing value if not updated
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier request deleted successfully');
    }
}
