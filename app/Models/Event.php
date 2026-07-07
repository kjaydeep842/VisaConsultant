<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'banner', 'description', 'venue', 'city',
        'event_date', 'event_end_date', 'fee', 'seats_available',
        'is_online', 'meeting_link', 'status', 'is_active'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_end_date' => 'datetime',
        'fee' => 'decimal:2',
        'seats_available' => 'integer',
        'is_online' => 'boolean',
        'is_active' => 'boolean',
    ];
}
