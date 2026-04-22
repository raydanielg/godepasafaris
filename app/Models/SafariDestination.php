<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SafariDestination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'short_description',
        'location',
        'best_time',
        'featured_image',
        'gallery',
        'icon',
        'badge',
        'badge_color',
        'is_featured',
        'is_active',
        'display_order',
        'highlight_1',
        'highlight_2',
        'highlight_3',
        'area',
        'established',
        'wildlife_count',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function activities(): HasMany
    {
        return $this->hasMany(SafariActivity::class)->orderBy('display_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
