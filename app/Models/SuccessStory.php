<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    protected $fillable = [
        'client_name', 'from_country', 'to_country', 'visa_type',
        'image', 'video_url', 'story', 'rating', 'is_featured', 'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'integer',
    ];
}
