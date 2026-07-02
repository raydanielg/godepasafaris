<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SafariDestination extends Model
{
    use Translatable;

    /** User-facing fields translated by the auto-translation pipeline. */
    public static array $translatable = [
        'name', 'tagline', 'description', 'short_description', 'location', 'best_time',
        'badge', 'highlight_1', 'highlight_2', 'highlight_3', 'area', 'established', 'wildlife_count',
    ];

    protected $fillable = [
        'name', 'slug', 'tagline', 'description', 'short_description',
        'location', 'best_time', 'featured_image', 'gallery', 'icon',
        'badge', 'badge_color', 'is_featured', 'is_active', 'display_order',
        'highlight_1', 'highlight_2', 'highlight_3', 'area', 'established', 'wildlife_count',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = ['display_image', 'hero_display_image'];

    private static array $fallbackImages = [
        'serengeti'         => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80',
        'ngorongoro'        => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
        'kilimanjaro'       => 'https://images.unsplash.com/photo-1621414050946-6e2f5a96b4aa?auto=format&fit=crop&w=1200&q=80',
        'mount-kilimanjaro'  => 'https://images.unsplash.com/photo-1621414050946-6e2f5a96b4aa?auto=format&fit=crop&w=1200&q=80',
        'tarangire'         => 'https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?auto=format&fit=crop&w=1200&q=80',
        'zanzibar'          => 'https://images.unsplash.com/photo-1586861203927-800a5acdcc7d?auto=format&fit=crop&w=1200&q=80',
        'manyara'           => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
        'lake-manyara'      => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
        'ruaha'             => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80',
        'selous'            => 'https://images.unsplash.com/photo-1504173010664-32509aeebb62?auto=format&fit=crop&w=1200&q=80',
        'mikumi'            => 'https://images.unsplash.com/photo-1546182990-dffeafbe841d?auto=format&fit=crop&w=1200&q=80',
        'arusha'            => 'https://images.unsplash.com/photo-1504173010664-32509aeebb62?auto=format&fit=crop&w=1200&q=80',
        'mahale'            => 'https://images.unsplash.com/photo-1518709766631-a6a7f45921c3?auto=format&fit=crop&w=1200&q=80',
        'gombe'             => 'https://images.unsplash.com/photo-1518709766631-a6a7f45921c3?auto=format&fit=crop&w=1200&q=80',
        'saadani'           => 'https://images.unsplash.com/photo-1586861203927-800a5acdcc7d?auto=format&fit=crop&w=1200&q=80',
        'katavi'            => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
        'rubondo'           => 'https://images.unsplash.com/photo-1504173010664-32509aeebb62?auto=format&fit=crop&w=1200&q=80',
        'mkomazi'           => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80',
        'pemba'             => 'https://images.unsplash.com/photo-1559054663-e8d23173b315?auto=format&fit=crop&w=1200&q=80',
        'maasai-mara'       => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80',
    ];

    public function getDisplayImageAttribute(): string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return $this->getSlugBasedFallback(600);
    }

    public function getHeroDisplayImageAttribute(): string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return $this->getSlugBasedFallback(1920);
    }

    private function getSlugBasedFallback(int $width): string
    {
        $slug = strtolower($this->slug ?? '');
        foreach (self::$fallbackImages as $keyword => $url) {
            if (str_contains($slug, $keyword)) {
                return str_replace('w=1200', "w={$width}", $url);
            }
        }
        return "https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w={$width}&q=80";
    }

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
