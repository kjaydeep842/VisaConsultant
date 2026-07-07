<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question', 'answer', 'category', 'country_id', 'visa_category_id',
        'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function visaCategory()
    {
        return $this->belongsTo(VisaCategory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
