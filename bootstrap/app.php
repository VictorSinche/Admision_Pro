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
            'auth.postulante' => \App\Http\Middleware\VerificarSesionPostulante::class,
            'auth.admin' => \App\Http\Middleware\VerificarSesionAdmin::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e) {
            if ($e->getStatusCode() === 403) {
                return response()->view('errors.403', [], 403);
            }

            if ($e->getStatusCode() === 404) {
                return response()->view('errors.404', [], 404);
            }

            return null; // usar el manejo por defecto para otros errores
        });
    })->create();
