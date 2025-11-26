<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'fecha_limite',
        'completado',
        'prioridad',
    ];

    protected $casts = [
        'fecha_limite' => 'date',
        'completado' => 'boolean',
    ];
}
