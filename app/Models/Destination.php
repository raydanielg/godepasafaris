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
        'rich_content',
        'weather_info',
        'faqs',
        'image', 
        'rate_range', 
        'best_time', 
        'high_season',
        'tripadvisor_reviews',
        'rating',
        'map_iframe'
    ];

    protected $casts = [
        'faqs' => 'array',
    ];

    //
}
