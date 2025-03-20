<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function events()
    {
        return response()->json(Event::all());
    }

    public function store(Request $request)
    {
        // Debugging: Check if the request is actually POST
        if ($request->isMethod('get')) {
            return response()->json(['error' => 'GET request is not allowed'], 405);
        }
    
        // Validate request data
        $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);
    
        // Store event
        $event = new Event();
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();
    
        return response()->json(['success' => true, 'event' => $event]);
    }
    
}
