<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    // **********************************
    // PUBLIC ACCESS METHODS (index & show)
    // **********************************

    /**
     * Display a listing of the announcements (PUBLIC).
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();

        // If this request is routed through the admin area, return the admin index view
        // so admins see the dedicated management page (with Edit/Delete actions).
        if (request()->routeIs('admin.*')) {
            return view('admin.announcements.index', compact('announcements'));
        }

        return view('announcements.index', compact('announcements'));
    }

    /**
     * Display the specified announcement (PUBLIC).
     */
    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    // **********************************
    // ADMIN CRUD METHODS (Protected by 'admin' middleware)
    // **********************************

    /**
     * Show the form for creating a new announcement (ADMIN).
     */
    public function create()
    {
        // Path View dipindahkan ke folder admin
        return view('admin.announcements.create'); 
    }

    /**
     * Store a newly created resource in storage (ADMIN).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create($validated);

        // Redirect ke Admin Index View yang baru
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berjaya dicipta!');
    }

    /**
     * Show the form for editing the specified announcement (ADMIN).
     */
    public function edit(Announcement $announcement)
    {
        // Path View dipindahkan ke folder admin
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage (ADMIN).
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berjaya dikemaskini!');
    }

    /**
     * Remove the specified resource from storage (ADMIN).
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berjaya dipadam!');
    }
}