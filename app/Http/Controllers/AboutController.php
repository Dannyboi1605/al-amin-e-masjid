<?php

namespace App\Http\Controllers;

use App\Models\AboutInfo;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     * Shows the latest about info or placeholders if none exists.
     */
    public function index()
    {
        // Get the latest about info entry
        $about = AboutInfo::latest()->first();

        return view('about.index', compact('about'));
    }
}
