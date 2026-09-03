<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    InterventionController,
    LocationController,
    NotificationController
};
use App\Http\Controllers\Client\{
    ClientDashboardController,
    ClientInterventionController,
    ClientProfileController
};
use App\Http\Controllers\Remorqueur\{
    RemorqueurDashboardController,
    RemorqueurInterventionController,
    RemorqueurProfileController,
    RemorqueurAvailabilityController
};
use App\Http\Controllers\Depanneur\{
    DepanneurDashboardController,
    DepanneurInterventionController,
    DepanneurProfileController,
    DepanneurAvailabilityController
};
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    AdminInterventionController,
    AdminProfessionalController,
    AdminClientController
};
use App\Http\Controllers\{
    Auth\AuthenticatedSessionController,
    Auth\AuthenticatedRegistrationController,
    Auth\ConfirmablePasswordController,
    Auth\EmailVerificationNotificationController,
    Auth\EmailVerificationPromptController,
    Auth\NewPasswordController,
    Auth\PasswordController,
    Auth\PasswordResetLinkController,
    Auth\VerifyEmailController
};

Route::get('/', function () {
    if (auth()->check()) {
        $roleRoute = match (auth()->user()->role) {
            'client' => 'client.dashboard',
            'remorqueur' => 'remorqueur.dashboard',
            'depanneur' => 'depanneur.dashboard',
            'admin' => 'admin.dashboard',
            default => 'login',
        };

        return redirect()->route($roleRoute);
    }

    return redirect()->route('login');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [AuthenticatedRegistrationController::class, 'create'])->name('register');
    Route::post('register', [AuthenticatedRegistrationController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::middleware('verified')->group(function () {
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('client')->middleware('role:client')->name('client.')->group(function () {
            Route::get('/', [ClientDashboardController::class, 'index'])->name('dashboard');
            Route::get('/intervention/nouvelle', [ClientInterventionController::class, 'create'])->name('intervention.create');
            Route::post('/intervention', [ClientInterventionController::class, 'store'])->name('intervention.store');
            Route::get('/professionnels-disponibles', [ClientInterventionController::class, 'nearbyProfessionals'])->name('intervention.nearby');
            Route::post('/location', [ClientInterventionController::class, 'updateLocation'])->name('location.update');
            Route::get('/interventions', [ClientInterventionController::class, 'index'])->name('intervention.index');
            Route::get('/intervention/{intervention}/professionnel-position', [ClientInterventionController::class, 'professionalPosition'])->name('intervention.professional-position');
            Route::get('/intervention/{intervention}', [ClientInterventionController::class, 'show'])->name('intervention.show');
            Route::post('/intervention/{intervention}/annuler', [ClientInterventionController::class, 'cancel'])->name('intervention.cancel');
            Route::post('/profile', [ClientProfileController::class, 'update'])->name('profile.update');
            Route::post('/profile/phone', [ClientProfileController::class, 'updatePhone'])->name('profile.phone');
            Route::post('/profile/photo', [ClientProfileController::class, 'updatePhoto'])->name('profile.photo');
            Route::get('/vehicles', [ClientProfileController::class, 'vehicles'])->name('vehicles.index');
            Route::post('/vehicles', [ClientProfileController::class, 'storeVehicle'])->name('vehicles.store');
            Route::delete('/vehicles/{vehicle}', [ClientProfileController::class, 'destroyVehicle'])->name('vehicles.destroy');
        });

        Route::prefix('remorqueur')->middleware('role:remorqueur')->name('remorqueur.')->group(function () {
            Route::get('/', [RemorqueurDashboardController::class, 'index'])->name('dashboard');
            Route::get('/disponibilite', [RemorqueurAvailabilityController::class, 'toggle'])->name('availability.toggle');
            Route::get('/demandes', [RemorqueurInterventionController::class, 'incoming'])->name('intervention.incoming');
            Route::post('/demandes/{intervention}/accepter', [RemorqueurInterventionController::class, 'accept'])->name('intervention.accept');
            Route::post('/demandes/{intervention}/refuser', [RemorqueurInterventionController::class, 'reject'])->name('intervention.reject');
            Route::get('/interventions', [RemorqueurInterventionController::class, 'index'])->name('intervention.index');
            Route::get('/intervention/{intervention}', [RemorqueurInterventionController::class, 'show'])->name('intervention.show');
            Route::post('/intervention/{intervention}/statut', [RemorqueurInterventionController::class, 'updateStatus'])->name('intervention.status');
            Route::post('/location', [RemorqueurAvailabilityController::class, 'updateLocation'])->name('location.update');
            Route::post('/profile', [RemorqueurProfileController::class, 'update'])->name('profile.update');
            Route::post('/remorque', [RemorqueurProfileController::class, 'updateRemorque'])->name('remorque.update');
            Route::post('/remorque/photo', [RemorqueurProfileController::class, 'updateRemorquePhoto'])->name('remorque.photo');
        });

        Route::prefix('depanneur')->middleware('role:depanneur')->name('depanneur.')->group(function () {
            Route::get('/', [DepanneurDashboardController::class, 'index'])->name('dashboard');
            Route::get('/disponibilite', [DepanneurAvailabilityController::class, 'toggle'])->name('availability.toggle');
            Route::get('/demandes', [DepanneurInterventionController::class, 'incoming'])->name('intervention.incoming');
            Route::post('/demandes/{intervention}/accepter', [DepanneurInterventionController::class, 'accept'])->name('intervention.accept');
            Route::post('/demandes/{intervention}/refuser', [DepanneurInterventionController::class, 'reject'])->name('intervention.reject');
            Route::get('/interventions', [DepanneurInterventionController::class, 'index'])->name('intervention.index');
            Route::get('/intervention/{intervention}', [DepanneurInterventionController::class, 'show'])->name('intervention.show');
            Route::post('/intervention/{intervention}/statut', [DepanneurInterventionController::class, 'updateStatus'])->name('intervention.status');
            Route::post('/location', [DepanneurAvailabilityController::class, 'updateLocation'])->name('location.update');
            Route::post('/profile', [DepanneurProfileController::class, 'update'])->name('profile.update');
            Route::post('/services', [DepanneurProfileController::class, 'updateServices'])->name('services.update');
        });

        Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::get('/interventions', [AdminInterventionController::class, 'index'])->name('intervention.index');
            Route::get('/intervention/{intervention}', [AdminInterventionController::class, 'show'])->name('intervention.show');
            Route::get('/clients', [AdminClientController::class, 'index'])->name('clients.index');
            Route::get('/client/{client}', [AdminClientController::class, 'show'])->name('clients.show');
            Route::post('/client/{client}/suspendre', [AdminClientController::class, 'suspend'])->name('clients.suspend');
            Route::post('/client/{client}/reactiver', [AdminClientController::class, 'reactivate'])->name('clients.reactivate');
            Route::get('/professionnels', [AdminProfessionalController::class, 'index'])->name('professionnels.index');
            Route::get('/professionnel/{professional}', [AdminProfessionalController::class, 'show'])->name('professionnels.show');
            Route::post('/professionnel/{professional}/valider', [AdminProfessionalController::class, 'validate'])->name('professionnels.validate');
            Route::post('/professionnel/{professional}/suspendre', [AdminProfessionalController::class, 'suspend'])->name('professionnels.suspend');
            Route::post('/professionnel/{professional}/reactiver', [AdminProfessionalController::class, 'reactivate'])->name('professionnels.reactivate');
            Route::get('/carte', [AdminDashboardController::class, 'map'])->name('map');
            Route::get('/statistiques', [AdminDashboardController::class, 'stats'])->name('stats');
        });

        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    });
});
