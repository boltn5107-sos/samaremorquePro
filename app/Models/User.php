<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role',
        'photo',
        'zone_intervention',
        'bio',
        'professional_info',
        'is_validated',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_validated' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function clientProfile()
    {
        return $this->hasOne(Client::class);
    }

    public function remorqueurProfile()
    {
        return $this->hasOne(Remorqueur::class);
    }

    public function depanneurProfile()
    {
        return $this->hasOne(Depanneur::class);
    }

    public function adminProfile()
    {
        return $this->hasOne(Admin::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function interventionsAsClient()
    {
        return $this->hasMany(Intervention::class, 'client_id');
    }

    public function interventionsAsProfessional()
    {
        return $this->hasMany(Intervention::class, 'professional_id');
    }

    public function remorque()
    {
        return $this->hasOne(Remorque::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function rejections()
    {
        return $this->hasMany(ProfessionalRejection::class, 'professional_id');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    public function readNotifications()
    {
        return $this->notifications()->whereNotNull('read_at');
    }

    public function getUnreadNotificationsCountAttribute(): int
    {
        return $this->notifications()->whereNull('read_at')->count();
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function isRemorqueur(): bool
    {
        return $this->role === 'remorqueur';
    }

    public function isDepanneur(): bool
    {
        return $this->role === 'depanneur';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
