<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Wave Money API (Business / Checkout)
    |--------------------------------------------------------------------------
    |
    | Les cles se recuperent depuis le portail Wave Business (Dev Portal).
    | Laisser les variables vides tant que vous n'avez pas recu vos cles.
    |
    | Modele metier (Option B) : la commission est payee PAR LE PROFESSIONNEL.
    | Le client regle le pro sur place ; la plateforme encaisse uniquement les
    | commissions des pros via Wave Checkout. Pas de produit "payout" requis.
    |
    */

    'environment' => env('WAVE_ENVIRONMENT', 'sandbox'),

    'sandbox' => [
        'api_key' => env('WAVE_API_KEY_SANDBOX', ''),
        'signing_secret' => env('WAVE_API_SIGNING_SECRET_SANDBOX', ''),
    ],

    'live' => [
        'api_key' => env('WAVE_API_KEY', ''),
        'signing_secret' => env('WAVE_API_SIGNING_SECRET', ''),
    ],

    /*
    | URL de base de l'API Wave (les routes sont sous /v1/...)
    */
    'base_url' => env('WAVE_API_URL', 'https://api.wave.com'),

    /*
    | Devise par defaut des paiements (Wave supporte XOF sans decimales)
    */
    'currency' => env('WAVE_CURRENCY', 'XOF'),

    /*
    | URLs de redirection utilisees lors du checkout.
    */
    'success_url' => env('WAVE_SUCCESS_URL', ''),
    'error_url' => env('WAVE_ERROR_URL', ''),

    /*
    | Secretariat partage pour verifier les webhooks Wave (optionnel mais
    | fortement recommande pour securiser la confirmation des paiements).
    */
    'webhook_secret' => env('WAVE_WEBHOOK_SECRET', ''),

    /*
    |----------------------------------------------------------------------
    | Commission (Option B) et seuil de blocage
    |----------------------------------------------------------------------
    |
    | commission_amount    : montant fixe (FCFA) que le professionnel doit
    |                        payer a chaque intervention terminee ET validee.
    | commission_block_after : nombre de commissions impayees au-dela duquel
    |                          le pro ne recoit plus de nouvelles demandes.
    |  Ex. 750 FCFA x 3 = 2250 FCFA : solde dû >= 2250 -> blocage.
    */
    'commission_amount' => (int) env('WAVE_COMMISSION_AMOUNT', 750),
    'commission_block_after' => (int) env('WAVE_COMMISSION_BLOCK_AFTER', 3),
];
