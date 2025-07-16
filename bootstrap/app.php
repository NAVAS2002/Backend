<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php', // ← AÑADIDO
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Puedes agregar alias de middleware si los necesitas
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Puedes agregar manejo personalizado de errores si lo necesitas
    })->create();
