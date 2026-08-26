<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_section_id',
        'title',
        'url',
        'icon',
        'badge',
        'badge_color',
        'description',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    public function section()
    {
        return $this->belongsTo(MenuSection::class, 'menu_section_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order');
    }

    /** Hex for this link's badge — shared with the section so colours stay consistent. */
    public function getBadgeHexAttribute(): string
    {
        return MenuSection::badgeHex($this->badge_color);
    }

    /**
     * A link change must invalidate the cached mega menu too, otherwise an admin
     * edit would not show up until the cache expired.
     */
    protected static function booted(): void
    {
        static::saved(fn () => MenuSection::flushMenuCache());
        static::deleted(fn () => MenuSection::flushMenuCache());
    }
}
