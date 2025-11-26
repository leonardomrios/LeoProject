<?php

use App\Http\Controllers\AutoanalisisController;
use App\Http\Controllers\DofaController;
use App\Http\Controllers\ObjetivoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('objetivos.index');
});

Route::resource('objetivos', ObjetivoController::class);
Route::resource('dofa', DofaController::class);
Route::resource('autoanalisis', AutoanalisisController::class);
