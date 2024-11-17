<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BuyerController extends Controller
{
    // Display a list of all buyers
    public function index()
    {
        $buyers = Buyer::all(); // Fetch all buyers from the database
        return view('Vendor.Bid.index', compact('buyers')); // Pass buyers to the view
    }
    
    // Show the buyer registration form
    public function create()
    {
        return view('vendor.buyer.create');
    }

    // Handle buyer registration
    public function store(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:buyers',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new buyer
        Buyer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'buyer',   // Default role
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('buyer.login')->with('success', 'Registration successful! Please log in.');
    }

    // Show a buyer's profile
    public function show($id)
    {
        $buyer = Buyer::findOrFail($id);
        return view('vendor.buyer.show', compact('buyer'));
    }

    // Show the edit form for a buyer's profile
    public function edit($id)
    {
        $buyer = Buyer::findOrFail($id);
        return view('vendor.buyer.edit', compact('buyer'));
    }

    // Update a buyer's profile
    public function update(Request $request, $id)
    {
        $buyer = Buyer::findOrFail($id);

        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Update buyer details
        $buyer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('buyer.show', $buyer->id)->with('success', 'Profile updated successfully.');
    }

    // Delete a buyer account
    public function destroy($id)
    {
        $buyer = Buyer::findOrFail($id);
        $buyer->delete();

        return redirect()->route('buyer.index')->with('success', 'Buyer deleted successfully.');
    }
}
