<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = ['blog_id', 'user_id', 'name', 'email', 'comment', 'status', 'parent_id'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id')->where('status', 'approved');
    }
}
