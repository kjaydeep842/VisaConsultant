<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name', 'client_designation', 'avatar', 'country_approved',
        'visa_type', 'testimonial', 'video_url', 'photo_before', 'photo_after',
        'rating', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
