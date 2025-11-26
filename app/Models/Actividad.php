<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'progreso',
        'estado',
        'prioridad',
        'color',
        'orden',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'progreso' => 'integer',
    ];

    /**
     * Obtener el color según el estado
     */
    public function getColorAttribute($value)
    {
        if ($value) {
            return $value;
        }

        return match($this->estado) {
            'completado' => '#10b981',
            'en_progreso' => '#6366f1',
            'pausado' => '#f59e0b',
            'pendiente' => '#94a3b8',
            default => '#94a3b8',
        };
    }

    /**
     * Obtener el color según la prioridad
     */
    public function getPrioridadColorAttribute()
    {
        return match($this->prioridad) {
            'critica' => '#ef4444',
            'alta' => '#f59e0b',
            'media' => '#6366f1',
            'baja' => '#10b981',
            default => '#94a3b8',
        };
    }

    /**
     * Calcular días totales de la actividad
     */
    public function getDiasTotalesAttribute()
    {
        return $this->fecha_inicio->diffInDays($this->fecha_fin) + 1;
    }

    /**
     * Calcular días transcurridos
     */
    public function getDiasTranscurridosAttribute()
    {
        $hoy = now()->startOfDay();
        $inicio = $this->fecha_inicio->startOfDay();
        
        if ($hoy < $inicio) {
            return 0;
        }
        
        if ($hoy > $this->fecha_fin->startOfDay()) {
            return $this->dias_totales;
        }
        
        return $inicio->diffInDays($hoy) + 1;
    }

    /**
     * Verificar si está retrasada
     */
    public function getEstaRetrasadaAttribute()
    {
        return now()->startOfDay() > $this->fecha_fin->startOfDay() && $this->estado !== 'completado';
    }

    /**
     * Verificar si está próxima a vencer
     */
    public function getEstaPorVencerAttribute()
    {
        $diasRestantes = now()->startOfDay()->diffInDays($this->fecha_fin->startOfDay(), false);
        return $diasRestantes >= 0 && $diasRestantes <= 3 && $this->estado !== 'completado';
    }
}
