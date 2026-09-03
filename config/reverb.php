<?php

return [
    'apps' => [
        [
            'id' => env('REVERB_APP_ID', 'sama-remorque'),
            'name' => env('APP_NAME', 'SamaRemorque'),
            'key' => env('REVERB_APP_KEY', 'local'),
            'secret' => env('REVERB_APP_SECRET', 'local'),
            'path' => 'apps/sama-remorque',
            'capacity' => null,
            'enable_client_messages' => false,
            'enable_statistics' => true,
        ],
    ],
    'options' => [
        'host' => env('REVERB_HOST', 'localhost'),
        'port' => env('REVERB_PORT', 8080),
        'scheme' => env('REVERB_SCHEME', 'http'),
        'useTLS' => env('REVERB_SCHEME', 'http') === 'https',
    ],
];
