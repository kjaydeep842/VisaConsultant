<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'category_id', 'author_id', 'excerpt', 'content',
        'featured_image', 'tags', 'status', 'published_at', 'views',
        'is_featured', 'allow_comments', 'meta_title', 'meta_description', 'focus_keyword',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'allow_comments' => 'boolean',
        'views' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class)->whereNull('parent_id')->where('status', 'approved');
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return null;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where('published_at', '<=', now());
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
