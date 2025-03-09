<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Configurar el middleware CORS usando el middleware integrado
        $middleware->use([HandleCors::class]);
        
        // También puedes configurar el grupo de api si necesitas
        // $middleware->api();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
