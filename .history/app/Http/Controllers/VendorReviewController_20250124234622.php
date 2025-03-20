<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorReview;

class VendorReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = VendorReview::all();
        return view('Vendor.VendorReview.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($vendor_id)
    {
        // Retrieve the vendor and pass it to the view
        $vendor = Vendor::findOrFail($vendor_id); // Assuming a Vendor model exists
        return view('Vendor.VendorReview.create', compact('vendor'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $vendorId)
    {
        $validatedData = $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|in:1,2,3,4,5',
        ]);
    
        // You can now use $vendorId in your store logic, for example:
        $vendor = Vendor::findOrFail($vendorId);
        
        VendorReview::create([
            'vendor_id' => $vendor->id,
            'reviewer_name' => $validatedData['reviewer_name'],
            'review_text' => $validatedData['review_text'],
            'rating' => $validatedData['rating'],
            'reviewed_at' => now(),
        ]);
    
         // Redirect to the login page with a success message
    return redirect()->route('login')->with('success', 'Vendor review created successfully. A status update has been sent to your email.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = VendorReview::findOrFail($id);
        return view('Vendor.VendorReview.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $review = VendorReview::findOrFail($id);
        return view('Vendor.VendorReview.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'reviewer_name' => 'required|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|in:1,2,3,4,5',
        ]);

        $review = VendorReview::findOrFail($id);
        $review->update($validatedData);

        return redirect()->route('vendorreview.index')->with('success', 'Vendor review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = VendorReview::findOrFail($id);
        $review->delete();

        return redirect()->route('vendorreview.index')->with('success', 'Vendor review deleted successfully.');
    }
}
