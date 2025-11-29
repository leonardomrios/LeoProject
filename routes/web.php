<?php

use App\Http\Controllers\AutoanalisisController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\DofaController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\SubactividadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('objetivos.index');
});

Route::resource('objetivos', ObjetivoController::class);
Route::resource('dofa', DofaController::class);
Route::resource('autoanalisis', AutoanalisisController::class);

// Rutas específicas de cronograma (deben ir antes del resource)
Route::get('cronograma/calendario', [CronogramaController::class, 'calendario'])->name('cronograma.calendario');
Route::post('cronograma/{cronograma}/progreso', [CronogramaController::class, 'updateProgreso'])->name('cronograma.progreso');
Route::resource('cronograma', CronogramaController::class);

// Subactividades
Route::get('subactividades/create', [SubactividadController::class, 'create'])->name('subactividades.create');
Route::post('subactividades', [SubactividadController::class, 'store'])->name('subactividades.store');
Route::get('cronograma/{actividad}/subactividades/{subactividad}/edit', [SubactividadController::class, 'edit'])->name('subactividades.edit');
Route::put('cronograma/{actividad}/subactividades/{subactividad}', [SubactividadController::class, 'update'])->name('subactividades.update');
Route::delete('cronograma/{actividad}/subactividades/{subactividad}', [SubactividadController::class, 'destroy'])->name('subactividades.destroy');
