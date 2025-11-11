<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    
    // Benarkan title dan content diisi secara pukal
    protected $fillable = [
        'title',
        'content',
    ];
}