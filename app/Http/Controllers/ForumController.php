<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of forum posts.
     */
    public function index()
    {
        $forums = Forum::with('author')
            ->latest()
            ->paginate(10);

        return view('forums.index', compact('forums'));
    }

    /**
     * Display the specified forum post with comments.
     */
    public function show(Forum $forum)
    {
        $forum->load([
            'author',
            'topLevelComments.user',
            'topLevelComments.replies.user',
            'topLevelComments.replies.replies.user'
        ]);

        return view('forums.show', compact('forum'));
    }
}
