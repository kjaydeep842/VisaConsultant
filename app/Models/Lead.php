<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'country_interested', 'visa_type',
        'age', 'education', 'experience_years', 'english_score', 'occupation',
        'budget', 'family_members', 'message', 'source', 'status',
        'assigned_to', 'follow_up_at', 'notes', 'eligibility_score',
        'utm_source', 'utm_medium', 'utm_campaign',
    ];

    protected $casts = [
        'follow_up_at' => 'datetime',
        'english_score' => 'decimal:1',
        'budget' => 'decimal:2',
    ];

    public function assignedConsultant()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
