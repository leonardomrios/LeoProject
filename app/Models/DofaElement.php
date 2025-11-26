<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DofaElement extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'prioridad',
    ];
}
