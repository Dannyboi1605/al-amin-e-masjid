<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'forum_id',
        'user_id',
        'parent_id',
        'content',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    /**
     * Get the forum post that owns the comment.
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * Get the user who wrote the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent comment.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Get all replies to this comment.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('is_hidden', false);
    }

    /**
     * Get all replies including hidden ones (for admin).
     */
    public function allReplies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Check if this comment is a reply.
     */
    public function isReply()
    {
        return !is_null($this->parent_id);
    }

    /**
     * Scope to get only visible comments.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }

    /**
     * Scope to get only hidden comments.
     */
    public function scopeHidden($query)
    {
        return $query->where('is_hidden', true);
    }
}
