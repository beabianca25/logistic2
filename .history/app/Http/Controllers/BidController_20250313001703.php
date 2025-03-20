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
        $bids = Bid::with(['auction', 'user'])->get();
        $auctions = Auction::all();
        $totalAuctions = Auction::count();
        $auctionsWithBids = Auction::whereHas('bids')->count();

        return view('Vendor.Bid.index', compact('bids', 'auctions'));
    }

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
        $bid->status = 'pending'; // ✅ Always set status to "pending"
    
        if (Auth::check()) {
            $bid->user_id = Auth::id();
        } else {
            $bid->user_id = null;
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'user_id' => 'required|exists:users,id',
            'bid_amount' => 'required|numeric|min:0',
            'status' => 'required|string'
        ]);
    
        $bid = Bid::findOrFail($id);
        
        $bid->update([
            'auction_id' => $request->auction_id,
            'user_id' => $request->user_id,
            'bid_amount' => $request->bid_amount,
            'status' => $request->status,
        ]);
    
        return redirect()->route('bid.index')->with('success', 'Bid updated successfully.');
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

    public function latestBids()
    {
        $bids = Bid::with(['auction', 'user']) // Fetch related auction and user data
            ->orderBy('created_at', 'desc')
            ->take(5) // Limit to the latest 5 bids
            ->get();

        return view('Vendor.Bid.latest', compact('bids'));
    }

    public function getBidCount()
{
    $bidCount = Bid::count();
    return response()->json(['bidCount' => $bidCount]);
}


}
