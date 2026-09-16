<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'brand',
        'model',
        'plate_number',
        'color',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
}
