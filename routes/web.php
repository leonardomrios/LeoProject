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
Route::resource('cronograma', CronogramaController::class);
Route::post('cronograma/{cronograma}/progreso', [CronogramaController::class, 'updateProgreso'])->name('cronograma.progreso');

// Subactividades
Route::post('cronograma/{actividad}/subactividades', [SubactividadController::class, 'store'])->name('subactividades.store');
Route::get('cronograma/{actividad}/subactividades/{subactividad}/edit', [SubactividadController::class, 'edit'])->name('subactividades.edit');
Route::put('cronograma/{actividad}/subactividades/{subactividad}', [SubactividadController::class, 'update'])->name('subactividades.update');
Route::delete('cronograma/{actividad}/subactividades/{subactividad}', [SubactividadController::class, 'destroy'])->name('subactividades.destroy');
