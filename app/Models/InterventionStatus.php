<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterventionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'intervention_id',
        'status',
        'note',
        'user_id',
    ];

    public function intervention(): BelongsTo
    {
        return $this->belongsTo(Intervention::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return Intervention::STATUS_LABELS[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }
}
