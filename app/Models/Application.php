<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'application_id', 'user_id', 'consultant_id', 'country_id',
        'visa_category_id', 'passport_number', 'applicant_name', 'dob',
        'nationality', 'status', 'current_stage', 'submission_date',
        'expected_completion', 'visa_issued_date', 'visa_expiry_date',
        'notes', 'total_fee', 'paid_amount',
    ];

    protected $casts = [
        'dob' => 'date',
        'submission_date' => 'date',
        'expected_completion' => 'date',
        'visa_issued_date' => 'date',
        'visa_expiry_date' => 'date',
        'total_fee' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->application_id = 'NV' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function visaCategory()
    {
        return $this->belongsTo(VisaCategory::class);
    }

    public function timelines()
    {
        return $this->hasMany(ApplicationTimeline::class);
    }

    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }
}
