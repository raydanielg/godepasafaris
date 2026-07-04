<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CulturalExperience extends Model
{
    protected $fillable = [
        'name', 'slug', 'region', 'tribe', 'tagline', 'meta_title', 'meta_description', 'description',
        'highlights', 'activities', 'price', 'duration', 'best_time',
        'image', 'gallery', 'icon', 'is_featured', 'is_active', 'display_order',
    ];

    protected $casts = [
        'gallery'     => 'array',
        'price'       => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(CulturalReview::class)->where('is_approved', true)->latest();
    }

    /** Editable child activities (named to avoid clashing with the `activities` text column). */
    public function activityItems(): HasMany
    {
        return $this->hasMany(CulturalActivity::class)->orderBy('display_order')->orderBy('id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** Resolve a stored image path to a public URL (no storage symlink needed). */
    public static function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        if (Str::startsWith($path, ['uploads/', 'images/', 'storage/'])) {
            return asset($path);
        }
        return asset('storage/' . ltrim($path, '/'));
    }

    public function getImageUrlAttribute(): ?string
    {
        return static::url($this->image);
    }

    public function getGalleryUrlsAttribute(): array
    {
        return array_values(array_filter(array_map(
            fn ($p) => static::url($p),
            is_array($this->gallery) ? $this->gallery : [],
        )));
    }

    public function getHighlightListAttribute(): array
    {
        return $this->lines($this->highlights);
    }

    public function getActivityListAttribute(): array
    {
        return $this->lines($this->activities);
    }

    private function lines(?string $text): array
    {
        if (! $text) {
            return [];
        }
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $text))));
    }
}
