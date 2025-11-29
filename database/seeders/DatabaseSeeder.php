<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Crear usuario de prueba solo si no existe
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
            ]
        );

        // Seed de actividades del roadmap ML Engineer
        $this->call([
            ActividadSeeder::class,
            ObjetivosProfesionalesSeeder::class,
            DofaElementSeeder::class,
            AutoanalisisRespuestaSeeder::class,
        ]);
    }
}
