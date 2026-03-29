<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafariPackage extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'summary', 
        'itinerary', 
        'inclusions', 
        'exclusions', 
        'price', 
        'image', 
        'days', 
        'category'
    ];

    protected $casts = [
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
    ];
}
