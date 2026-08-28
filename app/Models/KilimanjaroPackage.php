<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasTripDuration;

class KilimanjaroPackage extends Model
{
    use HasTripDuration;

    protected $fillable = [
        'title', 
        'slug', 
        'route_name', 
        'days', 
        'price', 
        'description', 
        'rich_content', 
        'itinerary', 
        'inclusions', 
        'exclusions', 
        'image'
    ];

    protected $casts = [
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
    ];
    //
}
