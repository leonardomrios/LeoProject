<?php

use App\Models\Actividad;
use App\Models\AutoanalisisRespuesta;
use App\Models\DofaElement;
use App\Models\Subactividad;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::bind('dofa', function ($value) {
                return DofaElement::findOrFail($value);
            });
            Route::bind('autoanalisi', function ($value) {
                return AutoanalisisRespuesta::findOrFail($value);
            });
            Route::bind('cronograma', function ($value) {
                return Actividad::findOrFail($value);
            });
            Route::bind('subactividad', function ($value) {
                return Subactividad::findOrFail($value);
            });
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
