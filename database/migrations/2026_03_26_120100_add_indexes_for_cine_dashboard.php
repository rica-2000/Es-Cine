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
        Schema::table('funcions', function (Blueprint $table) {
            $table->index('fecha', 'funcions_fecha_index');
            $table->index(['pelicula_id', 'fecha'], 'funcions_pelicula_fecha_index');
            $table->index(['sala_id', 'fecha'], 'funcions_sala_fecha_index');
            $table->index('deleted_at', 'funcions_deleted_at_index');
        });

        Schema::table('peliculas', function (Blueprint $table) {
            $table->index('genero', 'peliculas_genero_index');
            $table->index('deleted_at', 'peliculas_deleted_at_index');
        });

        Schema::table('salas', function (Blueprint $table) {
            $table->index('sucursal_id', 'salas_sucursal_id_index');
            $table->index('deleted_at', 'salas_deleted_at_index');
        });

        Schema::table('sucursals', function (Blueprint $table) {
            $table->index('deleted_at', 'sucursals_deleted_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcions', function (Blueprint $table) {
            $table->dropIndex('funcions_fecha_index');
            $table->dropIndex('funcions_pelicula_fecha_index');
            $table->dropIndex('funcions_sala_fecha_index');
            $table->dropIndex('funcions_deleted_at_index');
        });

        Schema::table('peliculas', function (Blueprint $table) {
            $table->dropIndex('peliculas_genero_index');
            $table->dropIndex('peliculas_deleted_at_index');
        });

        Schema::table('salas', function (Blueprint $table) {
            $table->dropIndex('salas_sucursal_id_index');
            $table->dropIndex('salas_deleted_at_index');
        });

        Schema::table('sucursals', function (Blueprint $table) {
            $table->dropIndex('sucursals_deleted_at_index');
        });
    }
};
