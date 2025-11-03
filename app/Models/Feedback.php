<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        // ... (fillable properties anda) ...
        'message',
        'email',
        'is_anonymous',
        'user_id',
        'status',
    ];

    /**
     * Define relationship: Feedback belongs to a User.
     */
    public function user()
    {
        // Kerana foreign key kita dinamakan 'user_id', Laravel akan auto-detect.
        // Kita boleh guna belongsTo() untuk link ke Model User.
        return $this->belongsTo(User::class);
    }
}
