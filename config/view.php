<?php

return [
    'default' => env('VIEW_COMPOUND_PATH', resource_path('views')),

    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env('VIEW_COMPILED_PATH', realpath(storage_path('framework/views'))),
];
