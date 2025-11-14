<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vision',
        'mission',
        'objectives',
        'images',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'images' => 'array', // Cast JSON to array automatically
        ];
    }
}
