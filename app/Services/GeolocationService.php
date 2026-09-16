<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeolocationService
{
    public function getClientPosition(Request $request): ?array
    {
        if ($request->filled('client_lat') && $request->filled('client_lng')) {
            return [
                'lat' => (float) $request->client_lat,
                'lng' => (float) $request->client_lng,
            ];
        }

        if ($request->filled('manual_position') || $request->filled('client_address')) {
            return $this->geocode($request->filled('manual_position') ? $request->manual_position : $request->client_address);
        }

        return null;
    }

    public function geocode(string $address): ?array
    {
        try {
            $response = Http::timeout(5)
                ->withHeaders(['User-Agent' => 'SamaRemorque/1.0'])
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => $address,
                    'format' => 'json',
                    'limit' => 1,
                    'countrycodes' => 'sn',
                ]);

            if ($response->successful()) {
                $result = collect($response->json())->first();

                if ($result) {
                    return [
                        'lat' => (float) $result['lat'],
                        'lng' => (float) $result['lon'],
                    ];
                }
            }
        } catch (\Throwable $e) {
            // fallthrough sur la position par defaut
        }

        return $this->defaultPosition();
    }

    public function defaultPosition(): array
    {
        return [
            'lat' => 14.7167,
            'lng' => -17.4677,
        ];
    }

    public function calculateDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371;

        $lat1Rad = deg2rad($lat1);
        $lat2Rad = deg2rad($lat2);
        $deltaLat = deg2rad($lat2 - $lat1);
        $deltaLng = deg2rad($lng2 - $lng1);

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos($lat1Rad) * cos($lat2Rad) *
             sin($deltaLng / 2) * sin($deltaLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
