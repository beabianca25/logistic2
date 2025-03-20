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
        // Retrieve all bids and auctions
        $bids = Bid::with(['auction', 'user'])->get();
        $auctions = Auction::all();

          // Count total auctions.
    $totalAuctions = Auction::count();

    // Count auctions that have at least one bid.
    $auctionsWithBids = Auction::whereHas('bids')->count();

    // Calculate bid rate as a percentage.
    $bidRate = $totalAuctions > 0 ? round(($auctionsWithBids / $totalAuctions) * 100) : 0;

        // Pass bids and auctions to the view
        return view('Vendor.Bid.index', compact('bids', 'auctions'));
    }


    // Show the form for creating a new bid
    public function create()
    {
        $auctions = Auction::all(); // Fetch all auctions from the database
        $users = User::all(); // Fetch all buyers from the database
        
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
    
        // Attempt to create a new bid (no check for existing bid)
        try {
            Bid::create([
                'auction_id' => $auction->id,
                'user_id' => Auth::id(),
                'bid_amount' => $request->bid_amount,
            ]);
    
            return redirect()->route('auction.show', $auctionId)
                             ->with('bid_success', 'Your bid was placed successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating bid: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while placing your bid.');
        }
    }
    
    // Display a specific bid
    public function show(Bid $bid)
    {
        return view('Vendor.Bid.show', compact('bid'));
    }

    // Show the form for editing a specific bid
    public function edit($id)
{
    $bid = Bid::findOrFail($id);
    $users = User::all(); // Assuming this is defined
    $auctions = Auction::all(); // Add this line to fetch all auctions

    return view('Vendor.Bid.edit', compact('bid', 'users', 'auctions'));
}


    // Update a specific bid in the database
    public function update(Request $request, Bid $bid)
    {
      
    
        $validatedData = $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'user_id' => 'required|exists:users,id',
            'bid_amount' => 'required|numeric|min:1',
            'status' => 'required|in:pending,active,outbid,winning,reserve not met,cancelled,closed,winning bid,losing bid,awarded,completed',
        ]);
    
        $bid->update($validatedData);
    
        return redirect()->route('bid.index')->with('success', 'Bid successfully updated!');
    }
    
    

    // Remove a specific bid from the database
    public function destroy(Bid $bid)
    {
        $bid->delete();
        return redirect()->route('bid.index')->with('success', 'Bid successfully deleted!');
    }

    public function getBidRate()
{
    // Count total auctions.
    $totalAuctions = Auction::count();

    // Count auctions that have at least one bid.
    $auctionsWithBids = Auction::whereHas('bids')->count();

    // Calculate bid rate as a percentage.
    $bidRate = $totalAuctions > 0 ? round(($auctionsWithBids / $totalAuctions) * 100) : 0;

    return response()->json(['bidRate' => $bidRate]);
}

}
