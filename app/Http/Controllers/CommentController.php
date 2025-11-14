<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Forum;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $validated['forum_id'] = $forum->id;
        $validated['user_id'] = auth()->id();

        Comment::create($validated);

        return redirect()->route('forums.show', $forum->slug)
            ->with('success', 'Comment posted successfully.');
    }

    /**
     * Toggle the hidden status of a comment (Admin only).
     */
    public function toggleHidden(Comment $comment)
    {
        $comment->update([
            'is_hidden' => !$comment->is_hidden
        ]);

        return back()->with('success', 'Comment visibility updated.');
    }

    /**
     * Soft delete a comment (Admin only).
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }

    /**
     * Restore a soft deleted comment (Admin only).
     */
    public function restore($id)
    {
        $comment = Comment::withTrashed()->findOrFail($id);
        $comment->restore();

        return back()->with('success', 'Comment restored successfully.');
    }

    /**
     * Permanently delete a comment (Admin only).
     */
    public function forceDelete($id)
    {
        $comment = Comment::withTrashed()->findOrFail($id);
        $comment->forceDelete();

        return back()->with('success', 'Comment permanently deleted.');
    }
}
