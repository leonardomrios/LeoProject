<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoanalisisRespuesta extends Model
{
    protected $fillable = [
        'pregunta_numero',
        'titulo',
        'contenido',
    ];

    /**
     * Obtener el texto de la pregunta según su número
     */
    public static function getPreguntaTexto($numero)
    {
        $preguntas = [
            1 => '¿Cómo puedo utilizar mis fortalezas para aprovechar las oportunidades disponibles en mi campo laboral?',
            2 => '¿Qué acciones puedo tomar para superar mis debilidades y convertirlas en fortalezas que me permitan enfrentar las amenazas existentes en mi carrera?',
            3 => '¿Cómo puedo aprovechar mis fortalezas para mitigar las amenazas externas que podrían afectar mi desarrollo profesional?',
            4 => '¿De qué manera puedo utilizar las oportunidades disponibles para mejorar y desarrollar las áreas donde tengo debilidades?',
        ];

        return $preguntas[$numero] ?? '';
    }

    /**
     * Obtener la descripción de la pregunta según su número
     */
    public static function getPreguntaDescripcion($numero)
    {
        $descripciones = [
            1 => 'Reflexiona sobre cómo tus habilidades y fortalezas pueden ser útiles para capitalizar las oportunidades identificadas en tu entorno profesional.',
            2 => 'Piensa en estrategias específicas para mejorar en las áreas donde tienes debilidades, de manera que puedas enfrentar las posibles amenazas con mayor preparación.',
            3 => 'Considera cómo tus habilidades y recursos pueden ayudarte a contrarrestar las amenazas externas y minimizar su impacto en tu carrera.',
            4 => 'Explora cómo puedes aprovechar las oportunidades del entorno laboral para mejorar tus áreas de mejora y adquirir nuevas habilidades.',
        ];

        return $descripciones[$numero] ?? '';
    }
}
