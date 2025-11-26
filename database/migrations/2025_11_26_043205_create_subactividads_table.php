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
        Schema::create('subactividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')->constrained('actividades')->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('progreso')->default(0)->comment('Porcentaje de 0 a 100');
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado', 'pausado'])->default('pendiente');
            $table->integer('orden')->default(0)->comment('Orden de visualización');
            $table->timestamps();
            
            $table->index('actividad_id');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subactividades');
    }
};
