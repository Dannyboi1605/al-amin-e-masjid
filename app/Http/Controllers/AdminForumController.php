<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminForumController extends Controller
{
    /**
     * Display a listing of forum posts in admin panel.
     */
    public function index()
    {
        $forums = Forum::with('author')
            ->withCount('comments')
            ->latest()
            ->paginate(15);

        return view('admin.forums.index', compact('forums'));
    }

    /**
     * Show the form for creating a new forum post.
     */
    public function create()
    {
        return view('admin.forums.create');
    }

    /**
     * Store a newly created forum post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Forum::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        Forum::create($validated);

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum post created successfully.');
    }

    /**
     * Show the form for editing the specified forum post.
     */
    public function edit(Forum $forum)
    {
        return view('admin.forums.edit', compact('forum'));
    }

    /**
     * Update the specified forum post in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Ensure unique slug (exclude current forum)
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Forum::where('slug', $validated['slug'])->where('id', '!=', $forum->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        $forum->update($validated);

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum post updated successfully.');
    }

    /**
     * Remove the specified forum post from storage.
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum post deleted successfully.');
    }

    /**
     * Display all comments for moderation.
     */
    public function comments(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $sort = $request->get('sort', 'newest');

        $query = \App\Models\Comment::with(['user', 'forum']);

        // Apply filters
        switch ($filter) {
            case 'hidden':
                $query->where('is_hidden', true);
                break;
            case 'visible':
                $query->where('is_hidden', false);
                break;
            case 'deleted':
                $query->onlyTrashed();
                break;
        }

        // Apply sorting
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $comments = $query->paginate(20);

        return view('admin.forums.comments', compact('comments', 'filter', 'sort'));
    }
}
