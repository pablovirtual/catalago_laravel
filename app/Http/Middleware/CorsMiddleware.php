<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Manejar las solicitudes preflight OPTIONS antes de cualquier otro procesamiento
        if ($request->isMethod('OPTIONS')) {
            $response = new Response('', 200);
        } else {
            $response = $next($request);
        }
        
        // Agregar los encabezados CORS necesarios
        $response->headers->set('Access-Control-Allow-Origin', 'https://cataangularcas-production.up.railway.app');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization, X-CSRF-TOKEN');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Max-Age', '86400'); // 24 horas
        
        return $response;
    }
}
