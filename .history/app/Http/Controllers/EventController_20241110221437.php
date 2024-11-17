<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                         ->whereDate('end', '<=', $request->end)
                         ->get(['id', 'title', 'start', 'end']);
    
            return response()->json($data);
        }
    
        return view('eventcalendar');
    }

    public function add(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->with('success', 'Event added successfully');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->back()->with('success', 'Event updated successfully');
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully');
    }

}
