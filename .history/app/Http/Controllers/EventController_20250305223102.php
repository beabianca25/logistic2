<?php

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Routing\Controller;

class EventController extends Controller
{
    public function events()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start->toIso8601String(), // ISO format
                'end' => $event->end->toIso8601String(),
                'backgroundColor' => $event->background_color ?? '#3788d8',
                'borderColor' => $event->border_color ?? '#3788d8',
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'background_color' => '#28a745',
            'border_color' => '#28a745',
        ]);

        return response()->json(['success' => 'Event added successfully!', 'event' => $event]);
    }
}
