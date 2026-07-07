<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'google_id', 'avatar',
        'role', 'status', 'otp', 'otp_expires_at', 'two_factor_enabled',
        'two_factor_secret', 'notes', 'preferred_country', 'preferred_language',
        'email_verified_at',
    ];

    protected $hidden = [
        'password', 'remember_token', 'otp', 'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function consultantAppointments()
    {
        return $this->hasMany(Appointment::class, 'consultant_id');
    }

    public function assignedLeads()
    {
        return $this->hasMany(Lead::class, 'assigned_to');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isConsultant()
    {
        return $this->role === 'consultant';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0B3D91&color=fff';
    }
}
