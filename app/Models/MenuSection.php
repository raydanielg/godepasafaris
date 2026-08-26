<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MenuSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'nav_item',
        'title',
        'description',
        'image',
        'link_url',
        'link_text',
        'badge',
        'badge_color',
        'display_order',
        'is_active',
        'use_custom_content',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'use_custom_content' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * The nav items that have a mega menu, in navbar order. Keys match the
     * `nav_item` column; values are the labels shown in the admin picker.
     */
    public const NAV_ITEMS = [
        'safari'       => 'Safaris',
        'kilimanjaro'  => 'Kilimanjaro',
        'destinations' => 'Destinations',
        'impact'       => 'Giving Back',
    ];

    /** Badge colours the mega menu knows how to render (see badgeHex()). */
    public const BADGE_COLORS = ['success', 'warning', 'danger', 'info', 'secondary'];

    public function links()
    {
        return $this->hasMany(MenuLink::class)->orderBy('display_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order');
    }

    public function scopeForNavItem($query, $navItem)
    {
        return $query->where('nav_item', $navItem)->where('is_active', true)->orderBy('display_order');
    }

    /**
     * Resolve the feature-card image to a usable URL. The stored value is either
     * a local upload path (uploads/…) or a full external URL, matching how
     * SiteSetting::image() treats background images. Returns null when unset so
     * callers can fall back to their own default.
     */
    public function getImageUrlAttribute(): ?string
    {
        $value = trim((string) $this->image);

        if ($value === '') {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://', '//', 'data:'])) {
            return $value;
        }

        return asset(ltrim($value, '/'));
    }

    /**
     * Map a badge colour name to the hex the mega menu paints. The markup used
     * a repeated inline ternary chain for this; centralising it keeps the
     * desktop menu, mobile menu and admin preview in agreement.
     */
    public static function badgeHex(?string $color): string
    {
        return match ($color) {
            'success'   => '#28a745',
            'danger'    => '#dc3545',
            'warning'   => '#ffc107',
            'info'      => '#17a2b8',
            'secondary' => '#6c757d',
            default     => '#8B4513',
        };
    }

    /**
     * The whole mega menu, cached, keyed by nav item. The navbar renders on
     * EVERY page, so without this each request fired a query per menu (4
     * sections + 4 link sets). Cleared automatically whenever a section or link
     * is saved or deleted — see booted() here and in MenuLink.
     */
    public static function menu(string $navItem): ?self
    {
        // Cache raw attribute ARRAYS, never the Eloquent objects themselves. The
        // cache store is "database", so anything cached is serialized into a text
        // column; serialized model instances come back as __PHP_Incomplete_Class
        // and blow up at render time. Arrays round-trip safely, and we rehydrate
        // real models below so callers still get ->image_url, ->badge_hex, etc.
        $payload = Cache::remember(self::cacheKey($navItem), now()->addDay(), function () use ($navItem) {
            $section = static::query()
                ->where('nav_item', $navItem)
                ->where('is_active', true)
                ->orderBy('display_order')
                ->first();

            if (! $section) {
                // Cache the miss too, so a missing section doesn't re-query on
                // every page load. Flushed like any other entry when data changes.
                return ['section' => null, 'links' => []];
            }

            return [
                'section' => $section->getAttributes(),
                'links'   => $section->links()
                    ->where('is_active', true)
                    ->orderBy('display_order')
                    ->get()
                    ->map(fn ($l) => $l->getAttributes())
                    ->all(),
            ];
        });

        if (empty($payload['section'])) {
            return null;
        }

        $section = (new static)->newFromBuilder($payload['section']);

        $section->setRelation('links', collect($payload['links'])
            ->map(fn ($attrs) => (new MenuLink)->newFromBuilder($attrs)));

        return $section;
    }

    public static function cacheKey(string $navItem): string
    {
        return 'mega_menu:' . $navItem;
    }

    /** Drop every cached mega menu. Cheap — there are only a handful of keys. */
    public static function flushMenuCache(): void
    {
        foreach (array_keys(self::NAV_ITEMS) as $navItem) {
            Cache::forget(self::cacheKey($navItem));
        }

        // Sections can exist for nav items outside the constant (older rows),
        // so clear those too rather than leaving a stale entry behind.
        try {
            static::query()->pluck('nav_item')->each(fn ($n) => Cache::forget(self::cacheKey($n)));
        } catch (\Throwable $e) {
            // Table missing on a fresh deploy — nothing cached yet either.
        }
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::flushMenuCache());
        static::deleted(fn () => static::flushMenuCache());
    }
}
