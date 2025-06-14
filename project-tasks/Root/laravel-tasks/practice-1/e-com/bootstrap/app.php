<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

//import middlewares
use App\Http\Middleware\Authentication;
use App\Http\Middleware\CheckRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //register middleware here
        // $middleware->append(Authentication::class);
        // $middleware->append(CheckRole::class);
        $middleware->alias([
            'auth.custom' => \App\Http\Middleware\Authentication::class,
            'checkRole' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    // Handle unauthenticated API calls globally
    $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Please log in.'
        ], 401);
    });
    })->create();
