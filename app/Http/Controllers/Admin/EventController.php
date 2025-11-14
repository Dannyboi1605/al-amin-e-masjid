<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /** Display a listing of events for admin. */
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    /** Show create form. */
    public function create()
    {
        return view('admin.events.create');
    }

    /** Store new event. */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'allow_volunteers' => 'boolean',
        ]);

        $data['user_id'] = auth()->id();

        // Ensure checkbox value present
        $data['allow_volunteers'] = isset($data['allow_volunteers']) ? (bool)$data['allow_volunteers'] : false;

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    /** Show edit form. */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    /** Display the specified event (admin view). */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    /** Update event. */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'allow_volunteers' => 'boolean',
        ]);

        $event = Event::findOrFail($id);
        $data['allow_volunteers'] = isset($data['allow_volunteers']) ? (bool)$data['allow_volunteers'] : false;
        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    /** Destroy event. */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
