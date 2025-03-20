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

    public function store(Request $request)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|min:1',
            'auctionId' => 'required|exists:auctions,id',
            'guest_name' => 'nullable|string|max:255',
            'guest_email' => 'nullable|email|max:255',
            'guest_phone' => 'nullable|string|max:20',
        ]);
    
        $auctionId = $request->input('auctionId');
        $auction = Auction::findOrFail($auctionId);
    
        // Save bid
        $bid = new Bid();
        $bid->auction_id = $auctionId;
        $bid->bid_amount = $request->bid_amount;
    
        if (Auth::check()) {
            // If logged in, store user_id
            $bid->user_id = Auth::id();
        } else {
            // If guest, store their contact details
            $bid->guest_name = $request->guest_name;
            $bid->guest_email = $request->guest_email;
            $bid->guest_phone = $request->guest_phone;
        }
    
        $bid->save();
    
        return redirect()->back()->with('success', 'Bid placed successfully!');
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
