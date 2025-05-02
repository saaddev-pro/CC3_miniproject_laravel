<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureAdminRole::class,
            'role' => \App\Http\Middleware\EnsureLibraryManagerRole::class, 
            'role.user' => \App\Http\Middleware\EnsureUserRole::class, 
            'role.library_manager' => \App\Http\Middleware\EnsureLibraryManagerRole::class,
            // Optionnel
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
