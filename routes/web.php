<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\adminController;
use App\Http\Controllers\sucursalesController;
use App\Http\Controllers\salasController;
use App\Http\Controllers\peliculasController;
use App\Http\Controllers\funcionesController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $salas = \App\Models\sala::orderBy('nombre')->get(['id', 'nombre']);
    return view('dashboard', compact('salas'));
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

        //Rutas de Sucursales
        Route::get('sucursales/index', [sucursalesController::class, 'index'])->name('sucursales.index');
        Route::post('sucursales/save', [sucursalesController::class, 'save'])->name('sucursales.save');
        Route::match(['put','patch'], 'sucursales/update/{id}', [sucursalesController::class, 'update'])->name('sucursales.update');
        Route::delete('sucursales/delete/{id}', [sucursalesController::class, 'delete'])->name('sucursales.delete');
        Route::get('sucursales/modifica/{id}', [sucursalesController::class, 'show'])->name('sucursales.show');

        //Rutas de Salas
        Route::get('salas/index', [salasController::class, 'index'])->name('salas.index');
        Route::post('salas/save', [salasController::class, 'save'])->name('salas.save');
        Route::match(['put','patch'], 'salas/update/{id}', [salasController::class, 'update'])->name('salas.update');
        Route::delete('salas/delete/{id}', [salasController::class, 'delete'])->name('salas.delete');
        Route::get('salas/modifica/{id}', [salasController::class, 'show'])->name('salas.show');

        //Rutas de peliculas
        Route::get('peliculas/index', [peliculasController::class, 'index'])->name('peliculas.index');
        Route::post('peliculas/save', [peliculasController::class, 'save'])->name('peliculas.save');
    Route::post('peliculas/import', [peliculasController::class, 'import'])->name('peliculas.import');
        Route::match(['put','patch'], 'peliculas/update/{id}', [peliculasController::class, 'update'])->name('peliculas.update');
        Route::delete('peliculas/delete/{id}', [peliculasController::class, 'delete'])->name('peliculas.delete');
        Route::get('peliculas/modifica/{id}', [peliculasController::class, 'show'])->name('peliculas.show');

    //Rutas de funciones
    Route::get('funciones/index', [funcionesController::class, 'index'])->name('funciones.index');
    Route::post('funciones/save', [funcionesController::class, 'save'])->name('funciones.save');
    Route::match(['put','patch'], 'funciones/update/{id}', [funcionesController::class, 'update'])->name('funciones.update');
    Route::delete('funciones/delete/{id}', [funcionesController::class, 'delete'])->name('funciones.delete');
    Route::get('funciones/modifica/{id}', [funcionesController::class, 'show'])->name('funciones.show');

    //Ruta para generar reporte de peliculas por sala
    Route::get('admin/reporte-peliculas-salas', [adminController::class, 'generarReportePeliculasSalas'])->name('admin.reportePeliculasSalas');
    
});

require __DIR__.'/auth.php';
