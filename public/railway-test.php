<?php
// Test file to verify basic PHP functionality on Railway
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://cataangularcas-production.up.railway.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization, X-CSRF-TOKEN');
header('Access-Control-Allow-Credentials: true');

// Si es una solicitud OPTIONS, responder inmediatamente con 200
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Información básica para diagnóstico
$info = [
    'status' => 'ok',
    'message' => 'Railway Laravel API is working',
    'time' => date('Y-m-d H:i:s'),
    'environment' => $_ENV,
    'server' => $_SERVER
];

echo json_encode($info);
