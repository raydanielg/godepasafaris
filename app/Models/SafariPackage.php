<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafariPackage extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'summary', 
        'description',
        'itinerary', 
        'inclusions', 
        'exclusions', 
        'price', 
        'currency',
        'image', 
        'days', 
        'category',
        'group_discount',
        'min_group_size',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
