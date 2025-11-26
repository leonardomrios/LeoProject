<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\Subactividad;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hoy = Carbon::now();
        $inicioPlan = $hoy->copy()->startOfWeek();
        
        // Limpiar actividades existentes
        Actividad::truncate();

        // FASE 1: Fundamentos y Conceptos Básicos (Semana 1-2)
        $actividad1 = Actividad::create([
            'nombre' => 'Fundamentos de Programación Orientada a Objetos',
            'descripcion' => 'Aprender los conceptos fundamentales de POO: clases, objetos, encapsulación, herencia, polimorfismo y abstracción.',
            'fecha_inicio' => $inicioPlan->copy(),
            'fecha_fin' => $inicioPlan->copy()->addDays(13),
            'progreso' => 0,
            'estado' => 'pendiente',
            'prioridad' => 'critica',
            'color' => '#6366f1',
        ]);

        Subactividad::create(['actividad_id' => $actividad1->id, 'nombre' => 'Introducción a POO: Historia y principios', 'descripcion' => 'Estudiar el origen de POO y sus principios fundamentales', 'fecha_inicio' => $inicioPlan->copy(), 'fecha_fin' => $inicioPlan->copy()->addDays(2), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 1]);
        Subactividad::create(['actividad_id' => $actividad1->id, 'nombre' => 'Clases y Objetos: Definición y creación', 'descripcion' => 'Aprender a definir clases y crear instancias de objetos', 'fecha_inicio' => $inicioPlan->copy()->addDays(3), 'fecha_fin' => $inicioPlan->copy()->addDays(5), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 2]);
        Subactividad::create(['actividad_id' => $actividad1->id, 'nombre' => 'Encapsulación: Atributos y métodos privados', 'descripcion' => 'Entender el concepto de encapsulación y modificadores de acceso', 'fecha_inicio' => $inicioPlan->copy()->addDays(6), 'fecha_fin' => $inicioPlan->copy()->addDays(8), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 3]);
        Subactividad::create(['actividad_id' => $actividad1->id, 'nombre' => 'Proyecto práctico: Crear primera clase', 'descripcion' => 'Implementar una clase completa con encapsulación', 'fecha_inicio' => $inicioPlan->copy()->addDays(9), 'fecha_fin' => $inicioPlan->copy()->addDays(13), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 4]);

        // FASE 2: Herencia y Polimorfismo (Semana 3-4)
        $actividad2 = Actividad::create([
            'nombre' => 'Herencia y Polimorfismo',
            'descripcion' => 'Dominar los conceptos de herencia, sobreescritura de métodos y polimorfismo para crear jerarquías de clases.',
            'fecha_inicio' => $inicioPlan->copy()->addDays(14),
            'fecha_fin' => $inicioPlan->copy()->addDays(27),
            'progreso' => 0,
            'estado' => 'pendiente',
            'prioridad' => 'critica',
            'color' => '#8b5cf6',
        ]);

        Subactividad::create(['actividad_id' => $actividad2->id, 'nombre' => 'Conceptos de Herencia: Clases padre e hijas', 'descripcion' => 'Aprender a crear jerarquías de clases mediante herencia', 'fecha_inicio' => $inicioPlan->copy()->addDays(14), 'fecha_fin' => $inicioPlan->copy()->addDays(17), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 1]);
        Subactividad::create(['actividad_id' => $actividad2->id, 'nombre' => 'Sobreescritura de métodos (Override)', 'descripcion' => 'Aprender a modificar el comportamiento de métodos heredados', 'fecha_inicio' => $inicioPlan->copy()->addDays(18), 'fecha_fin' => $inicioPlan->copy()->addDays(20), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 2]);
        Subactividad::create(['actividad_id' => $actividad2->id, 'nombre' => 'Polimorfismo: Múltiples formas', 'descripcion' => 'Entender cómo un objeto puede tomar múltiples formas', 'fecha_inicio' => $inicioPlan->copy()->addDays(21), 'fecha_fin' => $inicioPlan->copy()->addDays(24), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 3]);
        Subactividad::create(['actividad_id' => $actividad2->id, 'nombre' => 'Proyecto: Sistema de figuras geométricas', 'descripcion' => 'Crear un sistema con clases base y derivadas usando herencia y polimorfismo', 'fecha_inicio' => $inicioPlan->copy()->addDays(25), 'fecha_fin' => $inicioPlan->copy()->addDays(27), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 4]);

        // FASE 3: Abstracción e Interfaces (Semana 5-6)
        $actividad3 = Actividad::create([
            'nombre' => 'Abstracción e Interfaces',
            'descripcion' => 'Aprender a usar clases abstractas e interfaces para definir contratos y comportamientos comunes.',
            'fecha_inicio' => $inicioPlan->copy()->addDays(28),
            'fecha_fin' => $inicioPlan->copy()->addDays(41),
            'progreso' => 0,
            'estado' => 'pendiente',
            'prioridad' => 'alta',
            'color' => '#10b981',
        ]);

        Subactividad::create(['actividad_id' => $actividad3->id, 'nombre' => 'Clases Abstractas: Definición y uso', 'descripcion' => 'Aprender a crear y usar clases abstractas', 'fecha_inicio' => $inicioPlan->copy()->addDays(28), 'fecha_fin' => $inicioPlan->copy()->addDays(31), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 1]);
        Subactividad::create(['actividad_id' => $actividad3->id, 'nombre' => 'Interfaces: Contratos y múltiple herencia', 'descripcion' => 'Entender interfaces y cómo implementar múltiples contratos', 'fecha_inicio' => $inicioPlan->copy()->addDays(32), 'fecha_fin' => $inicioPlan->copy()->addDays(35), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 2]);
        Subactividad::create(['actividad_id' => $actividad3->id, 'nombre' => 'Diferencias: Abstractas vs Interfaces', 'descripcion' => 'Comprender cuándo usar clases abstractas y cuándo interfaces', 'fecha_inicio' => $inicioPlan->copy()->addDays(36), 'fecha_fin' => $inicioPlan->copy()->addDays(38), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 3]);
        Subactividad::create(['actividad_id' => $actividad3->id, 'nombre' => 'Proyecto: Sistema de pagos con interfaces', 'descripcion' => 'Implementar un sistema de pagos usando interfaces para diferentes métodos', 'fecha_inicio' => $inicioPlan->copy()->addDays(39), 'fecha_fin' => $inicioPlan->copy()->addDays(41), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 4]);

        // FASE 4: Principios SOLID (Semana 7-8)
        $actividad4 = Actividad::create([
            'nombre' => 'Principios SOLID',
            'descripcion' => 'Estudiar y aplicar los cinco principios SOLID para escribir código mantenible y escalable.',
            'fecha_inicio' => $inicioPlan->copy()->addDays(42),
            'fecha_fin' => $inicioPlan->copy()->addDays(55),
            'progreso' => 0,
            'estado' => 'pendiente',
            'prioridad' => 'alta',
            'color' => '#f59e0b',
        ]);

        Subactividad::create(['actividad_id' => $actividad4->id, 'nombre' => 'S - Single Responsibility Principle', 'descripcion' => 'Cada clase debe tener una única responsabilidad', 'fecha_inicio' => $inicioPlan->copy()->addDays(42), 'fecha_fin' => $inicioPlan->copy()->addDays(44), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 1]);
        Subactividad::create(['actividad_id' => $actividad4->id, 'nombre' => 'O - Open/Closed Principle', 'descripcion' => 'Abierto para extensión, cerrado para modificación', 'fecha_inicio' => $inicioPlan->copy()->addDays(45), 'fecha_fin' => $inicioPlan->copy()->addDays(47), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 2]);
        Subactividad::create(['actividad_id' => $actividad4->id, 'nombre' => 'L - Liskov Substitution Principle', 'descripcion' => 'Los objetos derivados deben poder sustituir a los base', 'fecha_inicio' => $inicioPlan->copy()->addDays(48), 'fecha_fin' => $inicioPlan->copy()->addDays(50), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 3]);
        Subactividad::create(['actividad_id' => $actividad4->id, 'nombre' => 'I - Interface Segregation Principle', 'descripcion' => 'Interfaces específicas mejor que una interfaz general', 'fecha_inicio' => $inicioPlan->copy()->addDays(51), 'fecha_fin' => $inicioPlan->copy()->addDays(52), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 4]);
        Subactividad::create(['actividad_id' => $actividad4->id, 'nombre' => 'D - Dependency Inversion Principle', 'descripcion' => 'Depender de abstracciones, no de concreciones', 'fecha_inicio' => $inicioPlan->copy()->addDays(53), 'fecha_fin' => $inicioPlan->copy()->addDays(54), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 5]);
        Subactividad::create(['actividad_id' => $actividad4->id, 'nombre' => 'Proyecto: Refactorizar código aplicando SOLID', 'descripcion' => 'Refactorizar un proyecto existente aplicando todos los principios SOLID', 'fecha_inicio' => $inicioPlan->copy()->addDays(55), 'fecha_fin' => $inicioPlan->copy()->addDays(55), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 6]);

        // FASE 5: Patrones de Diseño Básicos (Semana 9-10)
        $actividad5 = Actividad::create([
            'nombre' => 'Patrones de Diseño Fundamentales',
            'descripcion' => 'Aprender los patrones de diseño más comunes: Singleton, Factory, Observer y Strategy.',
            'fecha_inicio' => $inicioPlan->copy()->addDays(56),
            'fecha_fin' => $inicioPlan->copy()->addDays(69),
            'progreso' => 0,
            'estado' => 'pendiente',
            'prioridad' => 'media',
            'color' => '#ef4444',
        ]);

        Subactividad::create(['actividad_id' => $actividad5->id, 'nombre' => 'Patrón Singleton: Instancia única', 'descripcion' => 'Implementar el patrón Singleton para garantizar una única instancia', 'fecha_inicio' => $inicioPlan->copy()->addDays(56), 'fecha_fin' => $inicioPlan->copy()->addDays(59), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 1]);
        Subactividad::create(['actividad_id' => $actividad5->id, 'nombre' => 'Patrón Factory: Creación de objetos', 'descripcion' => 'Usar Factory para crear objetos sin especificar la clase exacta', 'fecha_inicio' => $inicioPlan->copy()->addDays(60), 'fecha_fin' => $inicioPlan->copy()->addDays(63), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 2]);
        Subactividad::create(['actividad_id' => $actividad5->id, 'nombre' => 'Patrón Observer: Notificaciones', 'descripcion' => 'Implementar Observer para notificar cambios a múltiples objetos', 'fecha_inicio' => $inicioPlan->copy()->addDays(64), 'fecha_fin' => $inicioPlan->copy()->addDays(66), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 3]);
        Subactividad::create(['actividad_id' => $actividad5->id, 'nombre' => 'Patrón Strategy: Algoritmos intercambiables', 'descripcion' => 'Usar Strategy para definir familias de algoritmos intercambiables', 'fecha_inicio' => $inicioPlan->copy()->addDays(67), 'fecha_fin' => $inicioPlan->copy()->addDays(69), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 4]);

        // FASE 6: Proyecto Final Integrador (Semana 11-12)
        $actividad6 = Actividad::create([
            'nombre' => 'Proyecto Final: Sistema Completo con POO',
            'descripcion' => 'Desarrollar un proyecto completo aplicando todos los conceptos aprendidos: herencia, polimorfismo, interfaces, SOLID y patrones de diseño.',
            'fecha_inicio' => $inicioPlan->copy()->addDays(70),
            'fecha_fin' => $inicioPlan->copy()->addDays(83),
            'progreso' => 0,
            'estado' => 'pendiente',
            'prioridad' => 'critica',
            'color' => '#10b981',
        ]);

        Subactividad::create(['actividad_id' => $actividad6->id, 'nombre' => 'Diseño del sistema: Arquitectura y clases', 'descripcion' => 'Diseñar la arquitectura del proyecto y definir las clases principales', 'fecha_inicio' => $inicioPlan->copy()->addDays(70), 'fecha_fin' => $inicioPlan->copy()->addDays(72), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 1]);
        Subactividad::create(['actividad_id' => $actividad6->id, 'nombre' => 'Implementación de clases base y herencia', 'descripcion' => 'Crear las clases base y establecer jerarquías mediante herencia', 'fecha_inicio' => $inicioPlan->copy()->addDays(73), 'fecha_fin' => $inicioPlan->copy()->addDays(76), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 2]);
        Subactividad::create(['actividad_id' => $actividad6->id, 'nombre' => 'Aplicación de interfaces y abstracción', 'descripcion' => 'Implementar interfaces para definir contratos y comportamientos', 'fecha_inicio' => $inicioPlan->copy()->addDays(77), 'fecha_fin' => $inicioPlan->copy()->addDays(79), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 3]);
        Subactividad::create(['actividad_id' => $actividad6->id, 'nombre' => 'Refactorización aplicando principios SOLID', 'descripcion' => 'Refactorizar el código para cumplir con los principios SOLID', 'fecha_inicio' => $inicioPlan->copy()->addDays(80), 'fecha_fin' => $inicioPlan->copy()->addDays(81), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 4]);
        Subactividad::create(['actividad_id' => $actividad6->id, 'nombre' => 'Implementación de patrones de diseño', 'descripcion' => 'Aplicar patrones de diseño apropiados donde sea necesario', 'fecha_inicio' => $inicioPlan->copy()->addDays(82), 'fecha_fin' => $inicioPlan->copy()->addDays(82), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 5]);
        Subactividad::create(['actividad_id' => $actividad6->id, 'nombre' => 'Documentación y presentación final', 'descripcion' => 'Documentar el proyecto y preparar presentación del sistema completo', 'fecha_inicio' => $inicioPlan->copy()->addDays(83), 'fecha_fin' => $inicioPlan->copy()->addDays(83), 'progreso' => 0, 'estado' => 'pendiente', 'orden' => 6]);

        // Recalcular progreso de todas las actividades
        Actividad::all()->each(function($actividad) {
            $actividad->calcularProgresoDesdeSubactividades();
        });

        $fechaInicio = Carbon::parse(Actividad::min('fecha_inicio'));
        $fechaFin = Carbon::parse(Actividad::max('fecha_fin'));
        $duracion = $fechaInicio->diffInDays($fechaFin) + 1;

        $this->command->info('✅ Se ha creado el roadmap de "Fundamentos de Programación Orientada a Objetos"');
        $this->command->info('   - ' . Actividad::count() . ' actividades principales');
        $this->command->info('   - ' . Subactividad::count() . ' subactividades');
        $this->command->info('   - Duración total: ' . $duracion . ' días');
    }
}
