<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id',
        'tour_name',
        'name',
        'email',
        'phone',
        'travel_date',
        'travelers',
        'accommodation',
        'message',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];
}
