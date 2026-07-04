<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CulturalReview extends Model
{
    protected $fillable = [
        'cultural_experience_id', 'name', 'location', 'rating', 'comment', 'is_approved',
    ];

    protected $casts = [
        'rating'      => 'integer',
        'is_approved' => 'boolean',
    ];

    public function experience(): BelongsTo
    {
        return $this->belongsTo(CulturalExperience::class, 'cultural_experience_id');
    }
}
