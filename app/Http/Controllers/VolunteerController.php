<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function create(Event $event)
    {
        // Only allow if event allows volunteers
        if (! $event->allow_volunteers) {
            return redirect()->back()->with('error', 'This event does not accept volunteers.');
        }

        return view('events.volunteer_create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'message' => 'nullable|string|max:2000',
        ]);

        if (! $event->allow_volunteers) {
            return redirect()->back()->with('error', 'This event does not accept volunteers.');
        }

        $user = Auth::user();

        // Prevent duplicate application
        $exists = Volunteer::where('user_id', $user->id)->where('event_id', $event->id)->exists();
        if ($exists) {
            return redirect()->route('events.show.public', $event->id)->with('info', 'You have already applied to volunteer for this event.');
        }

        $volunteer = Volunteer::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'message' => $request->input('message'),
            'status' => 'pending',
        ]);

    return redirect()->route('events.show.public', $event->id)->with('success', 'Volunteer application submitted.');
    }
}
