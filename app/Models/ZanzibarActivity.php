<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ZanzibarActivity extends Model
{
    protected $fillable = [
        'category', 'title', 'description', 'icon', 'image',
        'price', 'duration', 'best_time', 'details', 'display_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
    ];

    /** Human labels for the content categories shown on the Zanzibar page. */
    public const CATEGORIES = [
        'beaches'        => 'Beach Paradise',
        'stone_town'     => 'Stone Town Heritage',
        'culture'        => 'Swahili Culture',
        'spices'         => 'Spice Island',
        'turtle'         => 'Turtle Conservation',
        'marine'         => 'Marine Activities',
        'prison_island'  => 'Prison Island',
        'jozani'         => 'Jozani Forest',
        'packages'       => 'Tour Packages',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('id');
    }

    /** Resolved public URL for the item image, or null. */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        if (Str::startsWith($this->image, 'storage/')) {
            return asset($this->image);
        }
        return asset('storage/' . ltrim($this->image, '/'));
    }

    /** The `details` textarea split into a clean list of lines. */
    public function getDetailListAttribute(): array
    {
        if (! $this->details) {
            return [];
        }
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->details))));
    }
}
