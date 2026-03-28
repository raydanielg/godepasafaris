<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'category', 
        'description', 
        'image', 
        'rate_range', 
        'best_time', 
        'high_season'
    ];

    //
}
