<?php

namespace App\Http\Middleware;

use Closure;

class SetStoragePath
{
    public function handle($request, Closure $next)
    {
        // Configurar los directorios de almacenamiento temporal para Vercel
        config(['filesystems.disks.local.root' => '/tmp']);
        
        // Configurar las vistas compiladas en el directorio temporal
        config(['view.compiled' => '/tmp/framework/views']);

        // Configurar las sesiones en el directorio temporal
        config(['session.files' => '/tmp/framework/sessions']);
        
        // Configurar la caché en el directorio temporal
        config(['cache.stores.file.path' => '/tmp/framework/cache/data']);

        return $next($request);
    }
}