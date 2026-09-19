<?php

use App\Models\Intervention;

if (! function_exists('gmaps_route_url')) {
    /**
     * Lien "itineraire optimise" Google Maps entre le point de prise en charge
     * et la destination d'une intervention (si les coordonnees existent).
     */
    function gmaps_route_url(?Intervention $intervention): ?string
    {
        if (! $intervention) {
            return null;
        }

        if (! $intervention->client_lat || ! $intervention->client_lng ||
            ! $intervention->destination_lat || ! $intervention->destination_lng) {
            return null;
        }

        return 'https://www.google.com/maps/dir/?api=1'
            . '&origin=' . $intervention->client_lat . ',' . $intervention->client_lng
            . '&destination=' . $intervention->destination_lat . ',' . $intervention->destination_lng
            . '&travelmode=driving';
    }
}