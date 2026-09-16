# SamaRemorque - Plateforme de remorquage et depannage routier

Application Laravel 11 + MySQL + Blade + Tailwind CSS + Leaflet + PWA pour la mise en relation de conducteurs en panne avec des remorqueurs et depanneurs professionnels au Senegal.

## Stack technique

- Backend: Laravel 11 / PHP 8.2
- Frontend: Blade + Tailwind CSS + JavaScript
- Base de donnees: MySQL / MariaDB via XAMPP (local)
- Cartographie: Leaflet + OpenStreetMap
- API: Laravel REST API + Sanctum
- Temps reel: Laravel Reverb / WebSockets
- Authentification: Laravel Breeze / Sanctum
- PWA: Service Worker + Manifest
- Notifications: Web Push + SMS (structure pret)
- Serveur: Apache / Nginx

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run dev
php artisan serve
```

## Roles

- Client: conducteur en panne
- Remorqueur: transport de vehicule
- Depanneur: intervention sur place
- Admin: supervision plateforme

## Fonctionnalites V1

1. Authentification multi-roles
2. Interfaces Client / Remorqueur / Depanneur / Admin
3. Profils professionnels
4. Gestion des remorques
5. Services de depannage
6. Geolocalisation GPS
7. Recherche par proximite
8. Demande d'intervention
9. Acceptation / refus
10. Carte et trajet
11. Suivi en temps reel
12. Statuts d'intervention
13. Notifications
14. Historique
15. Administration
16. PWA installable
17. Securite Laravel
18. Deployment pret

## Workflow intervention

DEMANDE RECUE -> REMORQUEUR/DEPANNEUR EN ROUTE -> ARRIVEE SUR PLACE -> VEHICULE PRIS EN CHARGE -> INTERVENTION TERMINEE

## Environnement de developpement

- Windows + XAMPP
- PHP 8.2
- Composer
- Node.js 18+
- MySQL 8.0

## Deployment production

- VPS avec Nginx / Apache
- HTTPS obligatoire
- MySQL en production
- Laravel Reverb pour le temps reel
- Service Worker pour le mode hors ligne partiel
