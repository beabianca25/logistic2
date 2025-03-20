<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all(); // Fetch all events
        return view('Calendar.index', compact('events')); // Pass events to the view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'backgroundColor' => 'nullable|string',
            'borderColor' => 'nullable|string',
        ]);

        Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'backgroundColor' => $request->backgroundColor ?? '#3c8dbc',
            'borderColor' => $request->borderColor ?? '#3c8dbc',
        ]);

        return redirect()->route('calendar.index')->with('success', 'Event created successfully!');
    }

    public function events()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => \Carbon\Carbon::parse($event->start)->toISOString(),
                'end' => \Carbon\Carbon::parse($event->end)->toISOString(),
                'backgroundColor' => $event->backgroundColor,
                'borderColor' => $event->borderColor,
            ];
        });
    
        return response()->json($events);
    }
    
    

}
