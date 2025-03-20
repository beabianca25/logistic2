<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuctionController extends Controller
{
    /**
     * Display a listing of the auctions.
     */
    public function index(Request $request)
    {
        $type = $request->query('type'); // Get 'type' query parameter
        $search = $request->query('search');
        // If a type is selected, filter auctions by the specified type
        $auctions = Auction::when($search, function ($query, $search) {
            return $query->where('auction_title', 'like', '%' . $search . '%')
                         ->orWhere('category', 'like', '%' . $search . '%')
                         ->orWhere('type', 'like', '%' . $search . '%');
        })
        ->paginate(10); // Adjust pagination as needed
    
        return view('Vendor.Auction.index', compact('auctions', 'type'));
    }

    /**
     * Show the form for creating a new auction.
     */
    public function create(Request $request)
    {

        $type = $request->input('type'); // Get type if passed from URL or form
        return view('Vendor.Auction.create', compact('type'));
    }

    /**
     * Store a newly created auction in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'category' => 'required|string|max:255',
            'type' => 'required|string|in:product,service,rental',
            'auction_title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'description' => 'required|string',
            'condition' => 'nullable|string',
            'product_version' => 'nullable|string',
            'company' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'min_estimate_price' => 'nullable|numeric|min:0',
            'max_estimate_price' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date',
            'destination' => 'nullable|string',
            'duration' => 'nullable|string',
            'included_services' => 'nullable|string',
            'availability' => 'nullable|integer|min:0',
            'rental_duration_unit' => 'nullable|string|in:hour,day,week',
            'price_per_unit' => 'nullable|numeric|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        // Gather request data
        $data = $request->all();

           // Call AI for price prediction
           $aiResponse = Http::post('http://127.0.0.1:5000/predict', [
            'min_estimate_price' => $request->min_estimate_price,
            'max_estimate_price' => $request->max_estimate_price
        ]);

        $predictedPrices = $aiResponse->json();

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            // Store the photo in the 'public' disk and store the path in the data array
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // Create a new auction entry in the database
        Auction::create($data);

        // Redirect to the auctions index with a success message
        return redirect()->route('auction.index')->with('success', 'Auction created successfully.');
    }

    /**
     * Display the specified auction details.
     */
    public function show($id, Request $request)
    {
        $auction = Auction::find($id);
    
        if (!$auction) {
            return redirect()->route('auction.index')->with('error', 'Auction not found.');
        }
    
        // Retrieve the most recent bid for this auction
        $latestBid = Bid::where('auction_id', $auction->id)
            ->orderBy('created_at', 'desc')
            ->first();
    
        // Retrieve current user's bid if authenticated
        $userBid = null;
        
        if (Auth::check()) {
            $userBid = Bid::where('auction_id', $auction->id)
                ->where('user_id', Auth::id())
                ->first();
        } else {
            // Check for guest bid by email or phone if provided
            if ($request->has('guest_email') || $request->has('guest_phone')) {
                $userBid = Bid::where('auction_id', $auction->id)
                    ->where(function ($query) use ($request) {
                        if ($request->has('guest_email')) {
                            $query->orWhere('guest_email', $request->guest_email);
                        }
                        if ($request->has('guest_phone')) {
                            $query->orWhere('guest_phone', $request->guest_phone);
                        }
                    })
                    ->first();
            }
        }
    
        return view('Vendor.Auction.show', compact('auction', 'latestBid', 'userBid'));
    }
    

    /**
     * Show the form for editing the specified auction.
     */
    public function edit(Auction $auction)
    {
        return view('Vendor.Auction.edit', compact('auction'));
    }

    /**
     * Update the specified auction in storage.
     */
    public function update(Request $request, Auction $auction)
    {
        // Validate incoming request data
        $request->validate([
            'category' => 'required|string|max:255',
            'type' => 'required|string|in:product,service,rental',
            'auction_title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'description' => 'required|string',
            'condition' => 'nullable|string',
            'product_version' => 'nullable|string',
            'company' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'min_estimate_price' => 'nullable|numeric|min:0',
            'max_estimate_price' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date',
            'destination' => 'nullable|string',
            'duration' => 'nullable|string',
            'included_services' => 'nullable|string',
            'availability' => 'nullable|integer|min:0',
            'rental_duration_unit' => 'nullable|string|in:hour,day,week',
            'price_per_unit' => 'nullable|numeric|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $data = $request->all();

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // Update the existing auction record
        $auction->update($data);

        // Redirect to the auctions index with a success message
        return redirect()->route('auction.index')->with('success', 'Auction updated successfully.');
    }

    /**
     * Remove the specified auction from storage.
     */
    public function destroy(Auction $auction)
    {
        $auction->delete();
        return redirect()->route('auction.index')->with('success', 'Auction deleted successfully.');
    }

    public function publicAuctions() {
        $auctions = Auction::orderBy('end_date', 'asc')->get();
        return view('PublicShow.publicauction', compact('auctions'));
    }



    public function getPredictedPrice(Request $request)
    {
        $response = Http::post('http://127.0.0.1:5000/predict', [
            'min_estimate_price' => $request->min_estimate_price,
            'max_estimate_price' => $request->max_estimate_price
        ]);

        return response()->json($response->json());
    }

    
}
