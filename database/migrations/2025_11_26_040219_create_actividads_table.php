<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('progreso')->default(0)->comment('Porcentaje de 0 a 100');
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado', 'pausado'])->default('pendiente');
            $table->enum('prioridad', ['baja', 'media', 'alta', 'critica'])->default('media');
            $table->string('color')->nullable()->comment('Color personalizado en formato hex');
            $table->integer('orden')->default(0)->comment('Orden de visualización');
            $table->timestamps();
            
            $table->index(['fecha_inicio', 'fecha_fin']);
            $table->index('estado');
            $table->index('prioridad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
