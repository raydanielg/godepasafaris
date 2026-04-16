<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

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
}
