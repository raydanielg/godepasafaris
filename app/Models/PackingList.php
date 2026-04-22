<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackingList extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'icon',
        'image',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PackingItem::class)->orderBy('display_order');
    }

    public function essentialItems(): HasMany
    {
        return $this->hasMany(PackingItem::class)->where('is_essential', true)->orderBy('display_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
