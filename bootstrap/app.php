<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\TrackVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Middleware Aliases
        |--------------------------------------------------------------------------
        | You can use these in routes like:
        | Route::get('/admin', fn () => ...)->middleware('role');
        */
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Web Middleware Stack
        |--------------------------------------------------------------------------
        | This runs ONLY for web routes (sessions, cookies, views)
        */
        $middleware->web(append: [
            TrackVisitor::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom exception handling if needed
    })

    ->create();