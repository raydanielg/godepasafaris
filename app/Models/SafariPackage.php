<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Model;

class SafariPackage extends Model
{
    use Translatable;

    /** User-facing fields translated by the auto-translation pipeline. */
    public static array $translatable = [
        'title', 'summary', 'description', 'itinerary', 'inclusions', 'exclusions',
    ];

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
