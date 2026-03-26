<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $isRailway = !empty(env('RAILWAY_ENVIRONMENT')) || !empty(env('RAILWAY_PROJECT_ID'));
        $seedOnDeploy = filter_var(env('DEMO_DATA_ON_DEPLOY', false), FILTER_VALIDATE_BOOL);

        if (!$isRailway || !$seedOnDeploy) {
            return;
        }

        if (DB::table('sucursals')->exists() || DB::table('peliculas')->exists()) {
            return;
        }

        $now = Carbon::now();

        $sucursalCentro = DB::table('sucursals')->insertGetId([
            'nombre' => 'Cine Centro',
            'direccion' => 'Av. Central 101',
            'telefono' => '2222-1111',
            'director' => 'Ana Morales',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $sucursalNorte = DB::table('sucursals')->insertGetId([
            'nombre' => 'Cine Norte',
            'direccion' => 'Blvd. Norte 55',
            'telefono' => '2222-2222',
            'director' => 'Carlos Rivas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $salaCentro1 = DB::table('salas')->insertGetId([
            'nombre' => 'Sala 1',
            'capacidad' => 120,
            'sucursal_id' => $sucursalCentro,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $salaCentro2 = DB::table('salas')->insertGetId([
            'nombre' => 'Sala 2',
            'capacidad' => 90,
            'sucursal_id' => $sucursalCentro,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $salaNorte1 = DB::table('salas')->insertGetId([
            'nombre' => 'Sala A',
            'capacidad' => 140,
            'sucursal_id' => $sucursalNorte,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $salaNorte2 = DB::table('salas')->insertGetId([
            'nombre' => 'Sala B',
            'capacidad' => 80,
            'sucursal_id' => $sucursalNorte,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pelicula1 = DB::table('peliculas')->insertGetId([
            'titulo' => 'Luz de Medianoche',
            'director' => 'Sofia Campos',
            'duracion' => 115,
            'genero' => 'Drama',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pelicula2 = DB::table('peliculas')->insertGetId([
            'titulo' => 'Codigo Fantasma',
            'director' => 'Miguel Paredes',
            'duracion' => 102,
            'genero' => 'Suspenso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pelicula3 = DB::table('peliculas')->insertGetId([
            'titulo' => 'Mar en Calma',
            'director' => 'Elena Ruiz',
            'duracion' => 98,
            'genero' => 'Romance',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pelicula4 = DB::table('peliculas')->insertGetId([
            'titulo' => 'Orbita Final',
            'director' => 'Daniel Fuentes',
            'duracion' => 124,
            'genero' => 'Ciencia Ficcion',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pelicula5 = DB::table('peliculas')->insertGetId([
            'titulo' => 'Ritmo de Barrio',
            'director' => 'Paula Navas',
            'duracion' => 109,
            'genero' => 'Comedia',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pelicula6 = DB::table('peliculas')->insertGetId([
            'titulo' => 'Bosque Ancestral',
            'director' => 'Jorge Molina',
            'duracion' => 117,
            'genero' => 'Aventura',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $baseDate = Carbon::today()->setHour(17)->setMinute(30)->setSecond(0);

        $funciones = [
            ['fecha' => $baseDate->copy()->subDays(6), 'sala_id' => $salaCentro1, 'pelicula_id' => $pelicula1, 'tipo' => '2D', 'costo' => 45.00],
            ['fecha' => $baseDate->copy()->subDays(5), 'sala_id' => $salaCentro2, 'pelicula_id' => $pelicula2, 'tipo' => '3D', 'costo' => 55.00],
            ['fecha' => $baseDate->copy()->subDays(4), 'sala_id' => $salaNorte1, 'pelicula_id' => $pelicula4, 'tipo' => 'IMAX', 'costo' => 70.00],
            ['fecha' => $baseDate->copy()->subDays(3), 'sala_id' => $salaNorte2, 'pelicula_id' => $pelicula5, 'tipo' => '2D', 'costo' => 42.50],
            ['fecha' => $baseDate->copy()->subDays(2), 'sala_id' => $salaCentro1, 'pelicula_id' => $pelicula6, 'tipo' => '3D', 'costo' => 58.00],
            ['fecha' => $baseDate->copy()->subDays(1), 'sala_id' => $salaCentro2, 'pelicula_id' => $pelicula1, 'tipo' => '2D', 'costo' => 47.00],
            ['fecha' => $baseDate->copy(), 'sala_id' => $salaNorte1, 'pelicula_id' => $pelicula3, 'tipo' => '2D', 'costo' => 44.00],
            ['fecha' => $baseDate->copy()->addHours(3), 'sala_id' => $salaNorte2, 'pelicula_id' => $pelicula4, 'tipo' => 'IMAX', 'costo' => 72.00],
        ];

        foreach ($funciones as $funcion) {
            DB::table('funcions')->insert([
                'fecha' => $funcion['fecha'],
                'sala_id' => $funcion['sala_id'],
                'pelicula_id' => $funcion['pelicula_id'],
                'tipo' => $funcion['tipo'],
                'costo' => $funcion['costo'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback intencionalmente vacio para no eliminar datos reales.
    }
};
