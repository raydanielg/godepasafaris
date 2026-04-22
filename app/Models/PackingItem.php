<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackingItem extends Model
{
    protected $fillable = [
        'packing_list_id',
        'item_name',
        'description',
        'icon',
        'is_essential',
        'is_recommended',
        'display_order',
    ];

    protected $casts = [
        'is_essential' => 'boolean',
        'is_recommended' => 'boolean',
    ];

    public function packingList(): BelongsTo
    {
        return $this->belongsTo(PackingList::class);
    }

    public function scopeEssential($query)
    {
        return $query->where('is_essential', true);
    }

    public function scopeRecommended($query)
    {
        return $query->where('is_recommended', true);
    }
}
