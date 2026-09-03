<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('intervention.{interventionId}', function ($user, $interventionId) {
    $intervention = \App\Models\Intervention::findOrFail($interventionId);
    return $user->id === $intervention->client_id ||
           $user->id === $intervention->professional_id ||
           $user->role === 'admin';
});

Broadcast::channel('professional.{professionalId}', function ($user, $professionalId) {
    return $user->id === $professionalId || $user->role === 'admin';
});

Broadcast::channel('admin.map', function ($user) {
    return $user->role === 'admin';
});
