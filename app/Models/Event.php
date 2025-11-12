<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Event extends Model
{
    // Allow mass assignment for these columns
    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'user_id',
    ];

    // Cast the date field to a Carbon instance
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * The user who created the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
