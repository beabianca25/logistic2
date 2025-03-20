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
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ]);

        return response()->json(['success' => true, 'event' => $event]);
    }
}
