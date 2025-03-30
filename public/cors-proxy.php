<?php
/**
 * CORS Proxy para solicitudes desde Angular a Laravel en Railway
 * Este archivo actuará como intermediario para evitar problemas de CORS
 */

// Establecer encabezados CORS para permitir solicitudes desde la aplicación Angular
header('Access-Control-Allow-Origin: https://cataangularcas-production.up.railway.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-CSRF-TOKEN');
header('Access-Control-Allow-Credentials: true');

// Si es una solicitud OPTIONS, responder OK inmediatamente
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Obtener la ruta solicitada
$requestPath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$queryString = isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';

// Log para debugging
error_log("CORS Proxy: Accediendo a: " . $requestPath . $queryString);

// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener los encabezados de la solicitud
$headers = getallheaders();
$requestHeaders = [];
foreach ($headers as $key => $value) {
    if ($key !== 'Host') { // Evitar enviar el encabezado Host
        $requestHeaders[] = "$key: $value";
    }
}

// Obtener el cuerpo de la solicitud
$requestBody = file_get_contents('php://input');

// Inicializar curl para la solicitud interna
$ch = curl_init();

// Configurar la solicitud curl
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/api' . $requestPath . $queryString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);

// Ejecutar la solicitud
$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
    exit;
}

// Obtener información de la respuesta
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

// Cerrar la conexión
curl_close($ch);

// Establecer el código de estado HTTP
http_response_code($statusCode);

// Establecer el tipo de contenido
if ($contentType) {
    header("Content-Type: $contentType");
} else {
    header("Content-Type: application/json");
}

// Devolver la respuesta
echo $response;
