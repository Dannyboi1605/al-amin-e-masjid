<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($forum) {
            if (empty($forum->slug)) {
                $forum->slug = Str::slug($forum->title);
            }
        });

        static::updating(function ($forum) {
            if ($forum->isDirty('title')) {
                $forum->slug = Str::slug($forum->title);
            }
        });
    }

    /**
     * Get the author of the forum post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all comments for the forum post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get top-level comments (no parent).
     */
    public function topLevelComments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->where('is_hidden', false);
    }

    /**
     * Get route key name for model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
