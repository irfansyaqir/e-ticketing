<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'number_of_tickets' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($request->event_id);
        $user = Auth::user();

        if ($event->date < now()) {
            return response()->json(['message' => 'Event has passed.'], 400);
        }

        $booked = Booking::where('event_id', $event->id)->sum('number_of_tickets');
        $available = $event->total_tickets - $booked;

        if ($request->number_of_tickets > $available) {
            return response()->json(['message' => 'Not enough tickets available.'], 400);
        }

        // VIP logic: first 24h only VIP
        if ($event->created_at->addHours(24) > now() && !$user->is_vip) {
            return response()->json(['message' => 'VIP access only in first 24h.'], 400);
        }

        $total_price = $request->number_of_tickets * $event->ticket_price;

        $booking = Booking::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'number_of_tickets' => $request->number_of_tickets,
            'total_price' => $total_price,
        ]);

        return response()->json(['message' => 'Booking successful!', 'booking' => $booking]);
    }

    public function index()
    {
        $bookings = Booking::with('event')->where('user_id', Auth::id())->get();
        return response()->json($bookings);
    }

    public function cancel($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($booking->event->date < now()) {
            return response()->json(['message' => 'Cannot cancel past bookings.'], 400);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking cancelled']);
    }
}
