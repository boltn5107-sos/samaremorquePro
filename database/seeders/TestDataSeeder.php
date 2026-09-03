<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Depanneur;
use App\Models\Intervention;
use App\Models\InterventionStatus;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Remorque;
use App\Models\Remorqueur;
use App\Models\Service;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    protected $services = [];

    public function run(): void
    {
        DB::transaction(function () {
            $this->services = Service::pluck('id', 'name')->all();

            $this->seedClients();
            $this->seedProfessionals();
            $this->seedLocations();
            $this->seedDepanneurServices();
            $this->seedInterventions();
        });
    }

    protected function makeUser(array $attrs): User
    {
        return User::firstOrCreate(
            ['email' => $attrs['email']],
            array_merge([
                'first_name' => 'Test',
                'last_name' => 'Test',
                'phone' => '+221771234560',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ], $attrs)
        );
    }

    protected function seedClients(): void
    {
        $clients = [
            ['email' => 'awa@senegaltowing.sn', 'first_name' => 'Awa', 'last_name' => 'Diop', 'phone' => '+221771111111'],
            ['email' => 'moussa@senegaltowing.sn', 'first_name' => 'Moussa', 'last_name' => 'Ndiaye', 'phone' => '+221772222222'],
        ];

        $vehicles = [
            ['brand' => 'Toyota', 'model' => 'Corolla', 'plate_number' => 'DK-1234-AB', 'type' => 'voiture', 'color' => 'Blanc'],
            ['brand' => 'Renault', 'model' => 'Megane', 'plate_number' => 'DK-5678-CD', 'type' => 'voiture', 'color' => 'Gris'],
        ];

        foreach ($clients as $i => $data) {
            $user = $this->makeUser($data);
            Client::firstOrCreate(
                ['user_id' => $user->id],
                ['preferred_payment' => 'cash', 'emergency_contact' => $user->phone]
            );
            Vehicle::firstOrCreate(
                ['user_id' => $user->id, 'plate_number' => $vehicles[$i]['plate_number']],
                $vehicles[$i]
            );
        }
    }

    protected function seedProfessionals(): void
    {
        $remorqueurs = [
            [
                'email' => 'karim@senegaltowing.sn', 'first_name' => 'Karim', 'last_name' => 'Ba',
                'phone' => '+221773333333', 'zone_intervention' => 'Dakar, Senegal',
                'bio' => 'Remorqueur professionnel depuis 8 ans, materiel fiable.',
                'license_number' => 'RM-2021-001', 'experience_years' => 8, 'hourly_rate' => 15000,
            ],
        ];

        foreach ($remorqueurs as $data) {
            $profile = $data;
            unset($profile['license_number'], $profile['experience_years'], $profile['hourly_rate']);
            $profile['role'] = 'remorqueur';
            $profile['is_validated'] = true;
            $profile['is_active'] = true;

            User::where('email', $profile['email'])
                ->where('role', 'client')
                ->update(['role' => 'remorqueur']);

            $user = $this->makeUser($profile);
            Remorqueur::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'license_number' => $data['license_number'],
                    'experience_years' => $data['experience_years'],
                    'hourly_rate' => $data['hourly_rate'],
                    'is_available' => true,
                ]
            );
            Remorque::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'type' => 'plateau',
                    'capacity' => '3.5 tonnes',
                    'immatriculation' => 'DK-9900-TG',
                    'informations' => 'Plateau basculant, cablage securise.',
                ]
            );
        }

        $depanneurs = [
            [
                'email' => 'fatou@senegaltowing.sn', 'first_name' => 'Fatou', 'last_name' => 'Sarr',
                'phone' => '+221774444444', 'zone_intervention' => 'Dakar, Senegal',
                'bio' => 'Technicienne depannage toutes marques, disponible 24h/24.',
                'license_number' => 'DP-2022-014', 'experience_years' => 5, 'hourly_rate' => 12000,
                'services' => ['Depannage batterie', 'Depannage crevaison', 'Depannage demarrage'],
            ],
        ];

        foreach ($depanneurs as $data) {
            $services = $data['services'] ?? [];
            $profile = $data;
            unset($profile['license_number'], $profile['experience_years'], $profile['hourly_rate'], $profile['services']);
            $profile['role'] = 'depanneur';
            $profile['is_validated'] = true;
            $profile['is_active'] = true;

            User::where('email', $profile['email'])
                ->where('role', 'client')
                ->update(['role' => 'depanneur']);

            $user = $this->makeUser($profile);
            $dep = Depanneur::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'license_number' => $data['license_number'],
                    'experience_years' => $data['experience_years'],
                    'hourly_rate' => $data['hourly_rate'],
                    'is_available' => true,
                ]
            );
            if ($services) {
                $this->attachServices($dep, $services);
            }
        }
    }

    protected function attachServices(Depanneur $dep, array $names): void
    {
        $ids = collect($names)
            ->map(fn ($n) => $this->services[$n] ?? null)
            ->filter()
            ->values();
        $dep->services()->syncWithoutDetaching($ids);
    }

    protected function seedLocations(): void
    {
        $pros = User::whereIn('role', ['remorqueur', 'depanneur'])->get();
        $spots = [
            ['lat' => 14.7167, 'lng' => -17.4677, 'address' => 'Dakar Plateau'],
            ['lat' => 14.7521, 'lng' => -17.4770, 'address' => 'Dakar Yoff'],
            ['lat' => 14.7526, 'lng' => -17.3907, 'address' => 'Pikine'],
        ];

        $i = 0;
        foreach ($pros as $pro) {
            $spot = $spots[$i % count($spots)];
            Location::updateOrCreate(
                ['user_id' => $pro->id, 'lat' => $spot['lat'], 'lng' => $spot['lng']],
                ['address' => $spot['address'], 'recorded_at' => now()]
            );

            if ($pro->isRemorqueur()) {
                Remorqueur::updateOrCreate(
                    ['user_id' => $pro->id],
                    ['is_available' => true]
                );
            } elseif ($pro->isDepanneur()) {
                Depanneur::updateOrCreate(
                    ['user_id' => $pro->id],
                    ['is_available' => true]
                );
            }

            $i++;
        }
    }

    protected function seedDepanneurServices(): void
    {
        $dep = Depanneur::whereHas('user', fn ($q) => $q->where('email', 'depanneur@senegaltowing.sn'))->first();
        if ($dep) {
            $this->attachServices($dep, ['Depannage batterie', 'Depannage crevaison', 'Depannage demarrage', 'Panne mecanique']);
        }
    }

    protected function createIntervention(array $data): ?Intervention
    {
        $key = ['client_id' => $data['client_id'], 'description' => $data['description']];
        $intervention = Intervention::firstOrCreate(
            $key,
            array_diff_key($data, $key)
        );
        return $intervention;
    }

    protected function seedInterventions(): void
    {
        $awa = User::where('email', 'awa@senegaltowing.sn')->first();
        $moussa = User::where('email', 'moussa@senegaltowing.sn')->first();
        $clientSeed = User::where('email', 'client@senegaltowing.sn')->first();
        $remorqueurSeed = User::where('email', 'remorqueur@senegaltowing.sn')->first();
        $depanneurSeed = User::where('email', 'depanneur@senegaltowing.sn')->first();
        $karim = User::where('email', 'karim@senegaltowing.sn')->first();
        $fatou = User::where('email', 'fatou@senegaltowing.sn')->first();

        $awaVehicle = Vehicle::where('user_id', $awa->id)->first();
        $moussaVehicle = Vehicle::where('user_id', $moussa->id)->first();
        $seedVehicle = Vehicle::where('user_id', $clientSeed->id)->first();

        $awaVehicleId = $awaVehicle->id ?? null;
        $moussaVehicleId = $moussaVehicle->id ?? null;
        $seedVehicleId = $seedVehicle->id ?? null;

        $specs = [
            [
                'client' => $awa, 'vehicle' => $awaVehicleId, 'type' => 'remorquage',
                'desc' => 'Panne moteur, besoin de remorquage vers un garage a Rufisque.',
                'dest' => 'Garage Rufisque', 'dlat' => 14.7167, 'dlng' => -17.2667,
                'lat' => 14.7167, 'lng' => -17.4677, 'addr' => 'Route de Rufisque, Dakar',
                'status' => 'en_attente_professionnel', 'prof' => null,
            ],
            [
                'client' => $moussa, 'vehicle' => $moussaVehicleId, 'type' => 'depannage',
                'desc' => 'Batterie dechargee sur le parking du marche.',
                'dest' => 'Sur place', 'dlat' => null, 'dlng' => null,
                'lat' => 14.6854, 'lng' => -17.4429, 'addr' => 'Colobane, Dakar',
                'status' => 'en_attente_professionnel', 'prof' => null,
            ],
            [
                'client' => $clientSeed, 'vehicle' => $seedVehicleId, 'type' => 'remorquage',
                'desc' => 'Remorquage du vehicule de demonstration vers le centre.',
                'dest' => 'Centre ville Dakar', 'dlat' => 14.6699, 'dlng' => -17.4399,
                'lat' => 14.7526, 'lng' => -17.3907, 'addr' => 'Pikine, Dakar',
                'status' => 'remorqueur_en_route', 'prof' => $remorqueurSeed,
            ],
            [
                'client' => $awa, 'vehicle' => $awaVehicleId, 'type' => 'depannage',
                'desc' => 'Crevaison sur la voie express, depannage rapide demande.',
                'dest' => 'Vulcanisateur Yoff', 'dlat' => 14.7521, 'dlng' => -17.4770,
                'lat' => 14.7521, 'lng' => -17.4770, 'addr' => 'Voie express, Yoff',
                'status' => 'depanneur_en_route', 'prof' => $depanneurSeed,
            ],
            [
                'client' => $moussa, 'vehicle' => $moussaVehicleId, 'type' => 'remorquage',
                'desc' => 'Intervention terminee, remorquage effectue avec succes.',
                'dest' => 'Garage Plateau', 'dlat' => 14.6667, 'dlng' => -17.4331,
                'lat' => 14.6699, 'lng' => -17.4399, 'addr' => 'Plateau, Dakar',
                'status' => 'intervention_terminee', 'prof' => $karim,
            ],
            [
                'client' => $awa, 'vehicle' => $awaVehicleId, 'type' => 'depannage',
                'desc' => 'Demande annulee par le client avant l\'arrivee du professionnel.',
                'dest' => 'Sur place', 'dlat' => null, 'dlng' => null,
                'lat' => 14.6667, 'lng' => -17.4331, 'addr' => 'Plateau, Dakar',
                'status' => 'annulee', 'prof' => null,
            ],
        ];

        foreach ($specs as $s) {
            $intervention = $this->createIntervention([
                'client_id' => $s['client']->id,
                'professional_id' => $s['prof'] ? $s['prof']->id : null,
                'vehicle_id' => $s['vehicle'],
                'service_type' => $s['type'],
                'description' => $s['desc'],
                'client_lat' => $s['lat'],
                'client_lng' => $s['lng'],
                'client_address' => $s['addr'],
                'destination' => $s['dest'],
                'destination_lat' => $s['dlat'],
                'destination_lng' => $s['dlng'],
                'status' => $s['status'],
            ]);

            $this->seedStatusHistory($intervention, $s['status']);
            $this->seedNotifications($intervention, $s['status']);
        }
    }

    protected function seedStatusHistory(Intervention $intervention, string $finalStatus): void
    {
        $hasHistory = $intervention->statuses()->exists();
        if ($hasHistory) {
            return;
        }

        $history = [Intervention::STATUS_AWAITING_PROFESSIONAL];
        if (in_array($finalStatus, ['remorqueur_en_route', 'depanneur_en_route'], true)) {
            $history[] = $finalStatus;
        } elseif ($finalStatus === 'intervention_terminee') {
            $history[] = $intervention->service_type === 'remorquage' ? 'remorqueur_en_route' : 'depanneur_en_route';
            $history[] = 'arrivee_sur_place';
            $history[] = 'vehicule_pris_en_charge';
            $history[] = 'intervention_terminee';
        } elseif ($finalStatus === 'annulee') {
            $history[] = 'annulee';
        }

        foreach ($history as $offset => $status) {
            InterventionStatus::create([
                'intervention_id' => $intervention->id,
                'status' => $status,
                'note' => $status === Intervention::STATUS_AWAITING_PROFESSIONAL ? 'Demande creee (donnee de demonstration)' : null,
                'user_id' => $intervention->client_id,
                'created_at' => now()->subMinutes(count($history) - $offset),
                'updated_at' => now()->subMinutes(count($history) - $offset),
            ]);
        }
    }

    protected function seedNotifications(Intervention $intervention, string $finalStatus): void
    {
        foreach ($intervention->professional()->get() as $pro) {
            Notification::firstOrCreate(
                ['user_id' => $pro->id, 'notifiable_id' => $intervention->id, 'type' => 'new_intervention'],
                [
                    'notifiable_type' => Intervention::class,
                    'data' => [
                        'title' => 'Nouvelle demande',
                        'body' => 'Une nouvelle demande ' . $intervention->service_type . ' est disponible pres de vous.',
                        'url' => '/intervention/' . $intervention->id,
                    ],
                ]
            );
        }
    }
}
