<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Mail\VolunteerStatusChanged;
use Illuminate\Support\Facades\Mail;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::with(['user', 'event'])->orderBy('created_at', 'desc')->get();
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function show($id)
    {
        $volunteer = Volunteer::with(['user', 'event'])->findOrFail($id);
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function accept($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'accepted';
        $volunteer->save();

        Mail::to($volunteer->user->email)->send(new VolunteerStatusChanged($volunteer));

        return redirect()->route('admin.volunteers.index')->with('success', 'Volunteer accepted and user notified.');
    }

    public function reject($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'rejected';
        $volunteer->save();

        Mail::to($volunteer->user->email)->send(new VolunteerStatusChanged($volunteer));

        return redirect()->route('admin.volunteers.index')->with('success', 'Volunteer rejected and user notified.');
    }
}
