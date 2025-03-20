<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        return view('Calendar.index');
    }

    public function create()
{
    return view('calendar.add'); // Ensure this matches the Blade file path
}


    public function events()
    {
        return response()->json(Event::all());
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        // Save to database
        Event::create([
            'name' => $request->event_name,
            'date' => $request->event_date,
        ]);

        return redirect()->route('Calendar.create')->with('success', 'Event added successfully!');
    }
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
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
