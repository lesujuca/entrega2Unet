<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;

class SetStoragePath
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Configurar el directorio de almacenamiento temporal para Vercel
        config(['filesystems.disks.local.root' => '/tmp']);
        
        // Configurar las vistas compiladas en el directorio temporal
        config(['view.compiled' => '/tmp/storage/framework/views']);

        return $next($request);
    }
}