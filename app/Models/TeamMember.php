<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'photo',
        'bio',
        'email',
        'phone',
        'social_links',
        'specialization',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
