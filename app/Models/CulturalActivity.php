<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CulturalActivity extends Model
{
    protected $fillable = [
        'cultural_experience_id', 'name', 'description', 'icon', 'image', 'display_order',
    ];

    public function experience(): BelongsTo
    {
        return $this->belongsTo(CulturalExperience::class, 'cultural_experience_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return CulturalExperience::url($this->image);
    }
}
