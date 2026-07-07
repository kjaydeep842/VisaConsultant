<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_ref', 'user_id', 'lead_id', 'consultant_id', 'client_name',
        'client_email', 'client_phone', 'appointment_date', 'appointment_time',
        'branch', 'meeting_type', 'meeting_link', 'purpose', 'status', 'notes',
        'reminder_sent', 'fee', 'payment_status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'reminder_sent' => 'boolean',
        'fee' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->booking_ref = 'APT' . strtoupper(uniqid());
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

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
