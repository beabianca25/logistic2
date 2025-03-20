<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
{
    $events = Event::all(); // Retrieve all events
    return view('Calendar.index', compact('events')); // Pass events to the view
}


    public function create()
{
    return view('calendar.create'); // Ensure this matches the Blade file path
}


public function events()
{
    $events = Event::all()->map(function ($event) {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => Carbon::parse($event->start)->toIso8601String(),
            'end' => Carbon::parse($event->end)->toIso8601String(),
            'backgroundColor' => $event->backgroundColor,
            'borderColor' => $event->borderColor,
        ];
    });

    return response()->json($events);
}


    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'backgroundColor' => 'required|string',
            'borderColor' => 'required|string',
        ]);
    
        // Save to database
        Event::create([
            'title' => $request->title,
            'start' => Carbon::parse($request->start)->setTimezone('UTC'),
            'end' => Carbon::parse($request->end)->setTimezone('UTC'),
            'backgroundColor' => $request->backgroundColor,
            'borderColor' => $request->borderColor,
        ]);
    
        return redirect()->route('calendar.index')->with('success', 'Event added successfully!');
    }
    
    public function destroy($id)
    {
        $event = Event::find($id);
    
        if (!$event) {
            return response()->json(['message' => 'Event not found!'], 404);
        }
    
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully!']);
    }
    
    
    
    

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'start' => Carbon::parse($request->input('start'))->setTimezone('UTC'),
            'end' => Carbon::parse($request->input('end'))->setTimezone('UTC'),
            'backgroundColor' => $request->backgroundColor,
            'borderColor' => $request->borderColor,
        ]);

        return response()->json(['message' => 'Event updated successfully']);
    }

    public function resize(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $newEndDate = Carbon::parse($request->input('end'))->setTimezone('UTC');
        $event->update(['end' => $newEndDate]);

        return response()->json(['message' => 'Event resized successfully.']);
    }

    public function search(Request $request)
    {
        $searchKeywords = $request->input('title');

        $matchingEvents = Event::where('title', 'like', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }
}
