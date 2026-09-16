<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preferred_payment',
        'emergency_contact',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'client_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
