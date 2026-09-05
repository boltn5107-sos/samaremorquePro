<?php

namespace App\Services;

use App\Models\Intervention;
use Illuminate\Support\Facades\DB;

class NearbyProfessionalsService
{
    /**
     * @return array{professionals: array, suggested_destinations: array}
     */
    public function search(
        float $lat,
        float $lng,
        float $radiusKm = 50,
        int $freshnessMinutes = 720,
        ?string $serviceType = null
    ): array {
        $distanceSql = "(
            6371 * acos(
                cos(radians({$lat})) *
                cos(radians(locations.lat)) *
                cos(radians(locations.lng) - radians({$lng})) +
                sin(radians({$lat})) *
                sin(radians(locations.lat))
            )
        )";

        $query = DB::table('locations')
            ->join('users', 'users.id', '=', 'locations.user_id')
            ->whereIn('users.role', ['remorqueur', 'depanneur'])
            ->where('users.is_validated', true)
            ->where('users.is_active', true)
            ->where('locations.recorded_at', '>=', now()->subMinutes($freshnessMinutes))
            ->whereRaw($distanceSql . ' <= ' . $radiusKm);

        if ($serviceType) {
            $slug = strtolower($serviceType);
            $role = $slug === 'depannage' ? 'depanneur' : ($slug === 'remorquage' ? 'remorqueur' : null);

            if ($role) {
                $query->where('users.role', $role);
            }
        }

        $rows = $query
            ->join('remorqueurs', 'remorqueurs.user_id', '=', 'users.id', 'left')
            ->leftJoin('depanneurs', 'depanneurs.user_id', '=', 'users.id')
            ->whereRaw('COALESCE(remorqueurs.is_available, depanneurs.is_available) = 1')
            ->select([
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.role',
                'users.phone',
                'users.photo',
                'users.bio',
                'users.zone_intervention',
                'locations.lat',
                'locations.lng',
                'locations.recorded_at',
                'locations.address as location_address',
                'remorqueurs.hourly_rate as remorqueur_rate',
                'depanneurs.hourly_rate as depanneur_rate',
                DB::raw($distanceSql . ' as distance_km'),
            ])
            ->orderBy('distance_km', 'asc')
            ->orderByDesc('locations.recorded_at')
            ->limit(20)
            ->get();

        $professionals = $rows
            ->unique('id')
            ->values()
            ->map(function ($row) {
                $rate = $row->remorqueur_rate ?? $row->depanneur_rate;
                $suggestedDestination = $row->location_address ?: ($row->zone_intervention ?: null);

                return [
                    'id' => (int) $row->id,
                    'full_name' => trim("{$row->first_name} {$row->last_name}"),
                    'role' => $row->role,
                    'phone' => $row->phone,
                    'photo' => $row->photo ? asset('storage/' . $row->photo) : null,
                    'bio' => $row->bio,
                    'zone' => $row->zone_intervention,
                    'hourly_rate' => $rate ? (float) $rate : null,
                    'lat' => (float) $row->lat,
                    'lng' => (float) $row->lng,
                    'recorded_at' => $row->recorded_at,
                    'position_age_minutes' => round(max(0, now()->diffInMinutes($row->recorded_at)), 1),
                    'distance_km' => round((float) $row->distance_km, 2),
                    'suggested_destination' => $suggestedDestination,
                ];
            });

        $ratings = Intervention::ratingsForProfessionals($professionals->pluck('id')->all());
        $professionals = $professionals->map(function ($p) use ($ratings) {
            $p['rating_avg'] = $ratings[$p['id']]['average'] ?? null;
            $p['rating_count'] = $ratings[$p['id']]['count'] ?? 0;

            return $p;
        });

        return [
            'professionals' => $professionals->values()->all(),
            'suggested_destinations' => $this->suggestedDestinations($lat, $lng, $radiusKm),
        ];
    }

    protected function suggestedDestinations(float $lat, float $lng, float $radiusKm): array
    {
        $distanceSql = "(
            6371 * acos(
                cos(radians({$lat})) *
                cos(radians(locations.lat)) *
                cos(radians(locations.lng) - radians({$lng})) +
                sin(radians({$lat})) *
                sin(radians(locations.lat))
            )
        )";

        $destinations = DB::table('locations')
            ->join('users', 'users.id', '=', 'locations.user_id')
            ->where('users.role', 'depanneur')
            ->where('users.is_validated', true)
            ->where('users.is_active', true)
            ->whereRaw($distanceSql . ' <= ' . $radiusKm)
            ->whereRaw($distanceSql . ' > 0')
            ->select([
                'locations.address',
                'locations.lat',
                'locations.lng',
                DB::raw($distanceSql . ' as distance_km'),
            ])
            ->orderBy('distance_km', 'asc')
            ->limit(5)
            ->get()
            ->filter(fn ($d) => ! empty($d->address))
            ->map(fn ($d) => [
                'address' => $d->address,
                'distance_km' => round((float) $d->distance_km, 1),
            ])
            ->values()
            ->toArray();

        return $destinations;
    }
}