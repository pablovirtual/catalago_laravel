<?php
// Este archivo manejará las solicitudes CORS al nivel más básico
// Para diagnosticar problemas de Railway

// Configurar encabezados CORS
header('Access-Control-Allow-Origin: https://cataangularcas-production.up.railway.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-CSRF-TOKEN');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');

// Manejar solicitudes OPTIONS inmediatamente
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit;
}

// Si no es OPTIONS, redirigir a la aplicación principal
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$query = isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';

header('Location: /index.php' . $path . $query);
