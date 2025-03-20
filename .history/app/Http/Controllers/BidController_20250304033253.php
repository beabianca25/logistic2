<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class BidController extends Controller
{
    public function index()
    {
        // Retrieve all bids with related auction and user data
        $bids = Bid::with(['auction', 'user'])->get();
        $auctions = Auction::all();

        // Count total auctions
        $totalAuctions = Auction::count();

        // Count auctions that have at least one bid
        $auctionsWithBids = Auction::whereHas('bids')->count();

        // Calculate bid rate as a percentage
        $bidRate = $totalAuctions > 0 ? round(($auctionsWithBids / $totalAuctions) * 100) : 0;

        return view('Vendor.Bid.index', compact('bids', 'auctions', 'bidRate'));
    }

    // Show the form for creating a new bid
    public function create()
    {
        $auctions = Auction::all();
        $users = User::all();
        
        return view('Vendor.Bid.create', compact('auctions', 'users'));
    }

    public function store(Request $request, $auctionId)
    {
        // Validate the bid amount
        $request->validate([
            'bid_amount' => 'required|numeric|min:1',
        ]);

        // Find the auction by ID
        $auction = Auction::findOrFail($auctionId);

        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to place a bid.');
        }

        // Create a new bid without restrictions on previous bids
        try {
            Bid::create([
                'auction_id' => $auction->id,
                'user_id' => Auth::id(),
                'bid_amount' => $request->bid_amount,
            ]);

            return redirect()->route('auction.show', $auctionId)
                             ->with('success', 'Your bid was placed successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating bid: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while placing your bid.');
        }
    }

    public function show(Bid $bid)
    {
        return view('Vendor.Bid.show', compact('bid'));
    }

    public function edit($id)
    {
        $bid = Bid::findOrFail($id);
        $users = User::all();
        $auctions = Auction::all(); 

        return view('Vendor.Bid.edit', compact('bid', 'users', 'auctions'));
    }

    public function update(Request $request, Bid $bid)
    {
        // Validate request data
        $validatedData = $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'user_id' => 'required|exists:users,id',
            'bid_amount' => 'required|numeric|min:1',
            'status' => 'nullable|in:pending,active,outbid,winning,reserve not met,cancelled,closed,winning bid,losing bid,awarded,completed',
        ]);

        $bid->update($validatedData);

        return redirect()->route('bid.index')->with('success', 'Bid successfully updated!');
    }

    public function destroy(Bid $bid)
    {
        $bid->delete();
        return redirect()->route('bid.index')->with('success', 'Bid successfully deleted!');
    }

    public function getBidRate()
    {
        $totalAuctions = Auction::count();
        $auctionsWithBids = Auction::whereHas('bids')->count();
        $bidRate = $totalAuctions > 0 ? round(($auctionsWithBids / $totalAuctions) * 100) : 0;

        return response()->json(['bidRate' => $bidRate]);
    }
}
