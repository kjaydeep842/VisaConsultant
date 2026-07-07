<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'code', 'flag', 'banner', 'overview', 'benefits',
        'eligibility', 'required_documents', 'processing_time', 'visa_cost',
        'job_opportunities', 'universities', 'pr_pathway', 'faqs',
        'is_featured', 'is_active', 'sort_order', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'visa_cost' => 'decimal:2',
        'faqs' => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getFlagUrlAttribute()
    {
        if ($this->flag) {
            return asset('storage/' . $this->flag);
        }
        return "https://flagcdn.com/w80/{$this->code}.png";
    }

    public function getBannerUrlAttribute()
    {
        if ($this->banner) {
            return asset('storage/' . $this->banner);
        }
        return null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
