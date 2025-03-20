<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('Calendar.index', compact('events')); // Pass events to the view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);

        Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'backgroundColor' => $request->backgroundColor ?? '#3c8dbc',
            'borderColor' => $request->borderColor ?? '#3c8dbc'
        ]);

        return redirect()->back()->with('success', 'Event added successfully!');
    }
}
