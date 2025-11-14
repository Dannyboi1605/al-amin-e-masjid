<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function index(Request $request)
    {
        // Allow filtering by `filter=upcoming|past`. Default => upcoming
        $filter = $request->query('filter', 'upcoming');
        $today = Carbon::now()->startOfDay();

        // Sorting
        $sort = $request->query('sort'); // date_asc,date_desc,title_asc,title_desc,newest,oldest

        $query = Event::query();

        if ($filter === 'past') {
            $query->where('date', '<', $today);
        } elseif ($filter === 'upcoming') {
            $query->where('date', '>=', $today);
        } // if 'all' -> no where clause

        // Apply sorting
        if ($sort === 'date_asc') {
            $query->orderBy('date', 'asc');
        } elseif ($sort === 'date_desc') {
            $query->orderBy('date', 'desc');
        } elseif ($sort === 'title_asc') {
            $query->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $query->orderBy('title', 'desc');
        } elseif ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            // Default sorting: for modern sites, upcoming sorted by nearest date first.
            if ($filter === 'past') {
                $query->orderBy('date', 'desc');
            } else {
                $query->orderBy('date', 'asc');
            }
        }

        $events = $query->get();

        return view('events.index', compact('events', 'filter', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);
        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->location = $request->input('location');
        $event->user_id = auth()->id();
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->location = $request->input('location');
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
