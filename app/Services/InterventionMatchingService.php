<?php

namespace App\Services;

use App\Events\InterventionCreated;
use App\Models\Intervention;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class InterventionMatchingService
{
    protected function commissionBlockThreshold(): int
    {
        return (int) config('wave.commission_amount', 750) * max(1, (int) config('wave.commission_block_after', 3));
    }

    public function findAndNotify(Intervention $intervention, ?int $targetUserId = null): void
    {
        $lat = $intervention->client_lat;
        $lng = $intervention->client_lng;

        if ($targetUserId) {
            $candidate = User::find($targetUserId);
            if ($candidate && in_array($candidate->role, ['remorqueur', 'depanneur'])) {
                if ($candidate->isCommissionBlocked()) {
                    Log::info('Professionnel bloque (commissions impayees) : demande non notifiee', [
                        'professional_id' => $candidate->id,
                        'intervention_id' => $intervention->id,
                    ]);
                } else {
                    $this->notifyCandidate($candidate, $intervention);
                }
            }

            broadcast(new InterventionCreated($intervention));

            return;
        }

        if ($lat === null || $lng === null) {
            return;
        }

        $radiusKm = 50;

        $distanceSql = '(
            6371 * acos(
                GREATEST(-1, LEAST(1,
                    cos(radians(?)) *
                    cos(radians(locations.lat)) *
                    cos(radians(locations.lng) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(locations.lat))
                ))
            )
        )';

        $candidates = User::whereIn('role', ['remorqueur', 'depanneur'])
            ->where('is_validated', true)
            ->where('is_active', true)
            ->whereRaw(
                "(SELECT COALESCE(SUM(p.amount), 0) FROM payments p
                  WHERE p.user_id = users.id
                    AND p.payable_type = ?
                    AND p.status NOT IN ('paid', 'refunded')) < ?",
                [Intervention::class, $this->commissionBlockThreshold()]
            )
            ->join('locations', 'locations.user_id', '=', 'users.id')
            ->whereRaw($distanceSql.' <= ?', [$lat, $lng, $lat, $radiusKm])
            ->orderByRaw($distanceSql, [$lat, $lng, $lat])
            ->select('users.*')
            ->distinct()
            ->limit(10)
            ->get();

        foreach ($candidates as $candidate) {
            $this->notifyCandidate($candidate, $intervention);
        }

        broadcast(new InterventionCreated($intervention));
    }

    protected function notifyCandidate(User $candidate, Intervention $intervention): void
    {
        Notification::create([
            'user_id' => $candidate->id,
            'type' => 'new_intervention',
            'notifiable_type' => Intervention::class,
            'notifiable_id' => $intervention->id,
            'data' => [
                'title' => 'Nouvelle demande',
                'body' => 'Une nouvelle demande '.$intervention->service_type.' est disponible pres de vous.',
                'url' => '/intervention/'.$intervention->id,
                'photo' => $intervention->photo ? asset('storage/'.$intervention->photo) : null,
                'client_address' => $intervention->client_address,
                'client_phone' => $intervention->client_phone,
            ],
        ]);
    }
}
