<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subactividad extends Model
{
    protected $table = 'subactividades';

    protected $fillable = [
        'actividad_id',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'progreso',
        'estado',
        'orden',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'progreso' => 'integer',
    ];

    /**
     * Relación con la actividad padre
     */
    public function actividad(): BelongsTo
    {
        return $this->belongsTo(Actividad::class);
    }

    /**
     * Calcular progreso automáticamente basado en estado
     */
    public function calcularProgresoAutomatico(): void
    {
        $this->progreso = match($this->estado) {
            'completado' => 100,
            'en_progreso' => 50,
            'pausado' => 25,
            'pendiente' => 0,
            default => 0,
        };
    }
}
