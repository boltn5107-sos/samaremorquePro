<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_PAID = 'paid';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_FAILED = 'failed';
    public const STATUS_REFUNDED = 'refunded';
    public const STATUS_EXPIRED = 'expired';

    public const STATUS_LABELS = [
        self::STATUS_PENDING => 'En attente',
        self::STATUS_PROCESSING => 'En cours de traitement',
        self::STATUS_PAID => 'Paye',
        self::STATUS_CANCELLED => 'Annule',
        self::STATUS_FAILED => 'Echoue',
        self::STATUS_REFUNDED => 'Rembourse',
        self::STATUS_EXPIRED => 'Expire',
    ];

    protected $fillable = [
        'payable_type',
        'payable_id',
        'user_id',
        'provider',
        'checkout_id',
        'transaction_id',
        'client_reference',
        'amount',
        'currency',
        'status',
        'payment_status',
        'checkout_status',
        'error_message',
        'raw_payload',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'raw_payload' => 'array',
        'paid_at' => 'datetime',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsPaid(?array $payload = null): void
    {
        $this->update([
            'status' => self::STATUS_PAID,
            'payment_status' => 'succeeded',
            'checkout_status' => 'complete',
            'raw_payload' => $payload ?? $this->raw_payload,
            'paid_at' => now(),
        ]);
    }
}