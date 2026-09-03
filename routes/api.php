<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    InterventionApiController,
    LocationApiController,
    NotificationApiController,
    AuthController
};

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('client')->group(function () {
    Route::post('/intervention', [InterventionApiController::class, 'store']);
    Route::get('/intervention/{intervention}', [InterventionApiController::class, 'show']);
    Route::get('/interventions', [InterventionApiController::class, 'index']);
    Route::post('/location', [LocationApiController::class, 'update']);
});

Route::middleware('auth:sanctum')->prefix('remorqueur')->group(function () {
    Route::get('/demandes', [InterventionApiController::class, 'incoming']);
    Route::post('/demandes/{intervention}/accepter', [InterventionApiController::class, 'accept']);
    Route::post('/demandes/{intervention}/refuser', [InterventionApiController::class, 'reject']);
    Route::get('/interventions', [InterventionApiController::class, 'index']);
    Route::post('/intervention/{intervention}/statut', [InterventionApiController::class, 'updateStatus']);
    Route::post('/location', [LocationApiController::class, 'update']);
    Route::post('/disponibilite', [InterventionApiController::class, 'toggleAvailability']);
});

Route::middleware('auth:sanctum')->prefix('depanneur')->group(function () {
    Route::get('/demandes', [InterventionApiController::class, 'incoming']);
    Route::post('/demandes/{intervention}/accepter', [InterventionApiController::class, 'accept']);
    Route::post('/demandes/{intervention}/refuser', [InterventionApiController::class, 'reject']);
    Route::get('/interventions', [InterventionApiController::class, 'index']);
    Route::post('/intervention/{intervention}/statut', [InterventionApiController::class, 'updateStatus']);
    Route::post('/location', [LocationApiController::class, 'update']);
    Route::post('/disponibilite', [InterventionApiController::class, 'toggleAvailability']);
});

Route::middleware('auth:sanctum')->get('/notifications', [NotificationApiController::class, 'index']);
Route::middleware('auth:sanctum')->post('/notifications/{notification}/read', [NotificationApiController::class, 'markAsRead']);
