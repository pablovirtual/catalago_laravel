<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Añadir gestión básica de CORS antes de iniciar la aplicación
header('Access-Control-Allow-Origin: https://cataangularcas-production.up.railway.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization, X-CSRF-TOKEN');
header('Access-Control-Allow-Credentials: true');

// Manejar solicitudes OPTIONS antes de iniciar Laravel
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Ruta básica de diagnóstico - responderá a /api-status
if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === '/api-status') {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'ok',
        'message' => 'Laravel API is working',
        'time' => date('Y-m-d H:i:s')
    ]);
    exit;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
