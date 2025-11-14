<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the about info entries.
     */
    public function index()
    {
        $abouts = AboutInfo::latest()->paginate(10);
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new about info entry.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created about info entry in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vision' => 'required|string',
            'mission' => 'required|string',
            'objectives' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePaths = [];

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('about', 'public');
                $imagePaths[] = $path;
            }
        }

        AboutInfo::create([
            'vision' => $validated['vision'],
            'mission' => $validated['mission'],
            'objectives' => $validated['objectives'],
            'images' => $imagePaths,
        ]);

        return redirect()->route('admin.about.index')
            ->with('success', 'About info created successfully!');
    }

    /**
     * Show the form for editing the specified about info entry.
     */
    public function edit(AboutInfo $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified about info entry in storage.
     */
    public function update(Request $request, AboutInfo $about)
    {
        $validated = $request->validate([
            'vision' => 'required|string',
            'mission' => 'required|string',
            'objectives' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
        ]);

        $imagePaths = $about->images ?? [];

        // Delete selected images
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imagePath) {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePaths = array_filter($imagePaths, fn($path) => $path !== $imagePath);
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('about', 'public');
                $imagePaths[] = $path;
            }
        }

        $about->update([
            'vision' => $validated['vision'],
            'mission' => $validated['mission'],
            'objectives' => $validated['objectives'],
            'images' => array_values($imagePaths), // Re-index array
        ]);

        return redirect()->route('admin.about.index')
            ->with('success', 'About info updated successfully!');
    }

    /**
     * Remove the specified about info entry from storage.
     */
    public function destroy(AboutInfo $about)
    {
        // Delete all associated images
        if ($about->images) {
            foreach ($about->images as $imagePath) {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'About info deleted successfully!');
    }
}
