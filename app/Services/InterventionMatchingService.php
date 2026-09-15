<?php

namespace App\Services;

use App\Models\Intervention;
use App\Models\User;
use App\Models\Notification;
use App\Events\InterventionCreated;
use Illuminate\Support\Facades\DB;

class InterventionMatchingService
{
    public function findAndNotify(Intervention $intervention, ?int $targetUserId = null): void
    {
        $lat = $intervention->client_lat;
        $lng = $intervention->client_lng;

        if ($targetUserId) {
            $candidate = User::find($targetUserId);
            if ($candidate && in_array($candidate->role, ['remorqueur', 'depanneur'])) {
                $this->notifyCandidate($candidate, $intervention);
            }

            broadcast(new InterventionCreated($intervention));

            return;
        }

        if ($lat === null || $lng === null) {
            return;
        }

        $radiusKm = $this->radiusFor($intervention);

        $distanceSql = "(
            6371 * acos(
                cos(radians(?)) *
                cos(radians(locations.lat)) *
                cos(radians(locations.lng) - radians(?)) +
                sin(radians(?)) *
                sin(radians(locations.lat))
            )
        )";

        $candidates = User::whereIn('role', $this->rolesFor($intervention))
            ->where('is_validated', true)
            ->where('is_active', true)
            ->join('locations', 'locations.user_id', '=', 'users.id')
            ->whereRaw($distanceSql . ' <= ?', [$lat, $lng, $lat, $radiusKm])
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

    protected function radiusFor(Intervention $intervention): int
    {
        $vehicleType = strtolower($intervention->vehicle_type ?? '');

        return match ($vehicleType) {
            'conteneur' => 250,
            'camion', 'bus' => 200,
            default => 50,
        };
    }

    protected function rolesFor(Intervention $intervention): array
    {
        return match (strtolower($intervention->service_type ?? '')) {
            'remorquage' => ['remorqueur'],
            'depannage' => ['depanneur'],
            default => ['remorqueur', 'depanneur'],
        };
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
                'body' => 'Une nouvelle demande ' . $intervention->service_type . ' est disponible pres de vous.',
                'url' => '/intervention/' . $intervention->id,
                'photo' => $intervention->photo ? asset('storage/' . $intervention->photo) : null,
                'client_address' => $intervention->client_address,
                'client_phone' => $intervention->client_phone,
            ],
        ]);
    }
}
