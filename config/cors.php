<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'movies/*', 'movies'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:4200',  // URL de desarrollo local
        'https://cataangularcas-production.up.railway.app',  // URL de producción en Railway
        'https://*.up.railway.app'  // Cualquier subdominio de Railway (para futuras implementaciones)
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
