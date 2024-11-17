<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auctions = Auction::all();
        return view('vendor.auction.index', compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.auction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'auction_title' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'required',
            'condition' => 'required|string',
            'product_version' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'min_estimate_price' => 'required|numeric',
            'max_estimate_price' => 'required|numeric',
            'end_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        if($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }
    
        Auction::create($data);
        return redirect()->route('auction.index')->with('success', 'Auction created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $auction = Auction::find($id);
        $bid = Bid::where('auction_id', $auction->id)->orderBy('created_at', 'desc')->first(); // Fetch the latest bid for the auction
    
        return view('Vendor.Auction.show', compact('auction', 'bid'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auction $auction)
    {
        return view('vendor.auction.edit', compact('auction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auction $auction)
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'auction_title' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'required',
            'condition' => 'required|string',
            'product_version' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'min_estimate_price' => 'required|numeric',
            'max_estimate_price' => 'required|numeric',
            'end_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        if($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }
    
        $auction->update($data);
        return redirect()->route('auction.index')->with('success', 'Auction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auction $auction)
    {
        $auction->delete();
        return redirect()->route('auction.index')->with('success', 'Auction deleted successfully');
    }
}
