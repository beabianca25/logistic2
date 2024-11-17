<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Show the form to create a new event
    public function create()
    {
        return view('event.create'); // this will point to resources/views/event/create.blade.php
    }

    // Store the new event in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
        ]);

        // Create a new event and store it in the database
        Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'all_day' => $request->all_day ?? false, // optional, assuming 'all_day' is a checkbox
        ]);

        // Redirect back with a success message
        return redirect()->route('event.create')->with('success', 'Event created successfully!');
    }
}
