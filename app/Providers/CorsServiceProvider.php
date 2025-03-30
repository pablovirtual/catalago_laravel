<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Kernel;
use App\Http\Middleware\CorsMiddleware;

class CorsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Registrar el middleware en el grupo web y api
        $kernel = $this->app->make(Kernel::class);
        $kernel->prependMiddleware(CorsMiddleware::class);
        
        // Agregar un evento para después de enviar respuestas
        Response::macro('cors', function ($request) {
            $this->headers->set('Access-Control-Allow-Origin', '*');
            $this->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $this->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-CSRF-TOKEN');
            
            return $this;
        });
    }
}
