<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'title', 'image', 'category', 'description', 'is_active', 'sort_order', 'country_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'country_id' => 'integer',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
