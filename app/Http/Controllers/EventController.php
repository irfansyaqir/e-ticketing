<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all()->map(function($event) {
            $booked = Booking::where('event_id', $event->id)->sum('number_of_tickets');
            return [
                'id' => $event->id,
                'name' => $event->name,
                'date' => $event->date,
                'venue' => $event->venue,
                'available_tickets' => $event->total_tickets - $booked,
                'ticket_price' => $event->ticket_price,
            ];
        });

        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $booked = Booking::where('event_id', $event->id)->sum('number_of_tickets');

        return response()->json([
            'id' => $event->id,
            'name' => $event->name,
            'date' => $event->date,
            'venue' => $event->venue,
            'available_tickets' => $event->total_tickets - $booked,
            'ticket_price' => $event->ticket_price,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date|after:now',
            'venue' => 'required',
            'total_tickets' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        $event = Event::create($request->all());

        return response()->json(['message' => 'Event created', 'event' => $event]);
    }
}
