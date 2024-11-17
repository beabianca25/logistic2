<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index()
    {
        // Retrieve all bids and auctions
        $bids = Bid::with(['auction', 'buyer'])->get();
        $auctions = Auction::all();
    
        // Pass bids and auctions to the view
        return view('Vendor.Bid.index', compact('bids', 'auctions'));
    }
    

    // Show the form for creating a new bid
    public function create()
{
    $auctions = Auction::all();
    $buyers = Buyer::all(); // Assuming you need buyers too

    return view('Vendor.Bid.create', compact('auctions', 'buyers'));
}


    // Store a newly created bid in the database
    public function store(Request $request)
    {
        $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'buyer_id' => 'required|exists:buyers,id',
            'bid_amount' => 'required|numeric|min:0',
        ]);

        Bid::create([
            'auction_id' => $request->auction_id,
            'buyer_id' => $request->buyer_id,
            'bid_amount' => $request->bid_amount,
            'status' => 'pending',
        ]);

        return redirect()->route('bid.index')->with('success', 'Bid successfully placed!');
    }

    // Display a specific bid
    public function show(Bid $bid)
    {
        return view('vendor.bid.show', compact('bid'));
    }

    // Show the form for editing a specific bid
    public function edit(Bid $bid)
    {
        $auctions = Auction::all();
        $buyers = Buyer::all();
        return view('vendor.bid.edit', compact('bid', 'auctions', 'buyers'));
    }

    // Update a specific bid in the database
    public function update(Request $request, Bid $bid)
    {
        $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'buyer_id' => 'required|exists:buyers,id',
            'bid_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $bid->update($request->all());

        return redirect()->route('bid.index')->with('success', 'Bid successfully updated!');
    }

    // Remove a specific bid from the database
    public function destroy(Bid $bid)
    {
        $bid->delete();
        return redirect()->route('bid.index')->with('success', 'Bid successfully deleted!');
    }
}
