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
        Schema::create('autoanalisis_respuestas', function (Blueprint $table) {
            $table->id();
            $table->integer('pregunta_numero')->unsigned();
            $table->string('titulo')->nullable();
            $table->text('contenido');
            $table->timestamps();
            
            $table->unique('pregunta_numero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autoanalisis_respuestas');
    }
};
