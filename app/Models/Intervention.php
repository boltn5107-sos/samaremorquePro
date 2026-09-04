<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Intervention extends Model
{
    use HasFactory;

    public const STATUS_AWAITING_PROFESSIONAL = 'en_attente_professionnel';
    public const STATUS_RECEIVED = 'demande_recue';
    public const STATUS_REMORQUEUR_EN_ROUTE = 'remorqueur_en_route';
    public const STATUS_DEPANNEUR_EN_ROUTE = 'depanneur_en_route';
    public const STATUS_ARRIVED = 'arrivee_sur_place';
    public const STATUS_PICKED_UP = 'vehicule_pris_en_charge';
    public const STATUS_COMPLETED = 'intervention_terminee';
    public const STATUS_CANCELLED = 'annulee';

    public const STATUS_LABELS = [
        'en_attente_professionnel' => 'En attente d\'un professionnel',
        'demande_recue' => 'Demande recue',
        'remorqueur_en_route' => 'Remorqueur en route',
        'depanneur_en_route' => 'Depanneur en route',
        'arrivee_sur_place' => 'Arrive sur place',
        'vehicule_pris_en_charge' => 'Vehicule pris en charge',
        'intervention_terminee' => 'Intervention terminee',
        'annulee' => 'Annulee',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    public function statusLabelFor(string $status): string
    {
        return self::STATUS_LABELS[$status] ?? ucfirst(str_replace('_', ' ', $status));
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_AWAITING_PROFESSIONAL, self::STATUS_RECEIVED => 'bg-orange-100 text-orange-700',
            self::STATUS_ARRIVED, self::STATUS_PICKED_UP => 'bg-sky-100 text-sky-700',
            self::STATUS_COMPLETED => 'bg-emerald-100 text-emerald-700',
            self::STATUS_CANCELLED => 'bg-red-100 text-red-700',
            default => 'bg-orange-100 text-orange-700',
        };
    }

    protected $fillable = [
        'client_id',
        'professional_id',
        'target_professional_id',
        'vehicle_id',
        'service_type',
        'description',
        'photo',
        'status',
        'client_lat',
        'client_lng',
        'client_address',
        'destination',
        'destination_lat',
        'destination_lng',
        'distance_km',
        'estimated_duration_minutes',
        'client_manual_position',
        'rating',
        'rating_comment',
        'rated_at',
    ];

    protected $casts = [
        'client_lat' => 'decimal:7',
        'client_lng' => 'decimal:7',
        'destination_lat' => 'decimal:7',
        'destination_lng' => 'decimal:7',
        'distance_km' => 'decimal:2',
        'rating' => 'integer',
        'rated_at' => 'datetime',
    ];

    public const STATUS_PROGRESSION_REMORQUEUR = [
        self::STATUS_AWAITING_PROFESSIONAL,
        self::STATUS_REMORQUEUR_EN_ROUTE,
        self::STATUS_ARRIVED,
        self::STATUS_PICKED_UP,
        self::STATUS_COMPLETED,
    ];

    public const STATUS_PROGRESSION_DEPANNEUR = [
        self::STATUS_AWAITING_PROFESSIONAL,
        self::STATUS_DEPANNEUR_EN_ROUTE,
        self::STATUS_ARRIVED,
        self::STATUS_PICKED_UP,
        self::STATUS_COMPLETED,
    ];

    public function hasBeenRated(): bool
    {
        return $this->rating !== null;
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function professional(): BelongsTo
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function targetProfessional(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_professional_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(InterventionStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(InterventionStatus::class)->latestOfMany();
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function rejections(): HasMany
    {
        return $this->hasMany(ProfessionalRejection::class);
    }

    public function scopeAvailableForProfessional($query, $serviceType, $lat, $lng, $radiusKm = 50)
    {
        return $query->where('status', self::STATUS_AWAITING_PROFESSIONAL)
            ->where('service_type', $serviceType)
            ->whereRaw(
                "(
                    6371 * acos(
                        cos(radians(?)) *
                        cos(radians(client_lat)) *
                        cos(radians(client_lng) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(client_lat))
                    )
                ) <= ?",
                [$lat, $lng, $lat, $radiusKm]
            );
    }

    public function nextStatuses(): array
    {
        $progression = $this->professional && $this->professional->isDepanneur()
            ? self::STATUS_PROGRESSION_DEPANNEUR
            : self::STATUS_PROGRESSION_REMORQUEUR;

        $index = array_search($this->status, $progression);

        if ($index === false) {
            return [$this->status];
        }

        return array_slice($progression, $index + 1);
    }

    public function canTransitionTo(string $status): bool
    {
        if ($this->status === $status) {
            return false;
        }

        return in_array($status, $this->nextStatuses(), true);
    }

    public static function ratingsForProfessional(int $professionalId): array
    {
        $aggregate = self::query()
            ->where('professional_id', $professionalId)
            ->whereNotNull('rating')
            ->whereNotNull('rated_at')
            ->selectRaw('AVG(rating) as avg_rating, COUNT(*) as total_ratings')
            ->first();

        return [
            'average' => $aggregate && $aggregate->avg_rating !== null
                ? round((float) $aggregate->avg_rating, 1)
                : null,
            'count' => $aggregate ? (int) $aggregate->total_ratings : 0,
        ];
    }

    public static function ratingsForProfessionals(array $professionalIds): array
    {
        if (empty($professionalIds)) {
            return [];
        }

        $rows = self::query()
            ->whereIn('professional_id', $professionalIds)
            ->whereNotNull('rating')
            ->whereNotNull('rated_at')
            ->selectRaw('professional_id, AVG(rating) as avg_rating, COUNT(*) as total_ratings')
            ->groupBy('professional_id')
            ->get();

        return $rows->mapWithKeys(fn ($row) => [
            (int) $row->professional_id => [
                'average' => round((float) $row->avg_rating, 1),
                'count' => (int) $row->total_ratings,
            ],
        ])->all();
    }
}
