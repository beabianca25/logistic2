<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate the incoming request data
         $request->validate([
            'title' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'all_day' => 'nullable|boolean',
        ]);

        // Create and save the event
        Event::create([
            'title' => $request->title,
            'color' => $request->color,
            'start' => $request->start,
            'end' => $request->end,
            'all_day' => $request->all_day ?? false,
        ]);

        return redirect()->back()->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
