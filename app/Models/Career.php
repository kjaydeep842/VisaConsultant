<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'department', 'location', 'type',
        'description', 'requirements', 'salary_min', 'salary_max',
        'deadline', 'is_active'
    ];

    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    public function applications()
    {
        return $this->hasMany(CareerApplication::class);
    }
}
