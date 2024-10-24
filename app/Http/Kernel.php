<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \App\Http\Middleware\SetStoragePath::class,
        // Otros middlewares
    ];

    protected $middlewareGroups = [
        'web' => [
            // Otros middlewares
        ],
        'api' => [
            // Otros middlewares
        ],
    ];
}