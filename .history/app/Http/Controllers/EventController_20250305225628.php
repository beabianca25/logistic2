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

    public function events()
    {
        return response()->json(Event::all());
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'backgroundColor' => 'nullable|string',
            'borderColor' => 'nullable|string'
        ]);

        // Create new event
        $event = new Event();
        $event->title = $request->title;
        $event->start = Carbon::parse($request->start);
        $event->end = $request->end ? Carbon::parse($request->end) : null;
        $event->backgroundColor = $request->backgroundColor;
        $event->borderColor = $request->borderColor;
        $event->save();

        return response()->json(['success' => true, 'event' => $event]);
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
