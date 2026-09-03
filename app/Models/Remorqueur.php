<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Remorqueur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'experience_years',
        'hourly_rate',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'professional_id');
    }

    public function remorque()
    {
        return $this->hasOne(Remorque::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
