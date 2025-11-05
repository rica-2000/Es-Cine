<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\funcion as Funcion;
use App\Models\sala as Sala;
use App\Models\pelicula as Pelicula;

class funcionesController extends Controller
{
    public function index()
    {
        $salas = Sala::with('sucursal')->get();
        $peliculas = Pelicula::all();
        $funciones = Funcion::with(['sala.sucursal', 'pelicula'])->get();
        return view('funciones', compact('salas', 'peliculas', 'funciones'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'fecha' => ['required', 'date'],
            'sala_id' => ['required', 'exists:salas,id'],
            'pelicula_id' => ['required', 'exists:peliculas,id'],
            'tipo' => ['required', 'string', 'max:50'],
            'costo' => ['required', 'numeric', 'min:0'],
        ]);

        $funcion = new Funcion();
        $funcion->fecha = $validated['fecha'];
        $funcion->sala_id = $validated['sala_id'];
        $funcion->pelicula_id = $validated['pelicula_id'];
        $funcion->tipo = $validated['tipo'];
        $funcion->costo = $validated['costo'];
        $funcion->save();

        return redirect()->route('funciones.index');
    }

    public function show($id)
    {
        $funcion = Funcion::with(['sala.sucursal', 'pelicula'])->findOrFail($id);
        $salas = Sala::with('sucursal')->get();
        $peliculas = Pelicula::all();
        return view('funciones-modifica', compact('funcion', 'salas', 'peliculas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fecha' => ['required', 'date'],
            'sala_id' => ['required', 'exists:salas,id'],
            'pelicula_id' => ['required', 'exists:peliculas,id'],
            'tipo' => ['required', 'string', 'max:50'],
            'costo' => ['required', 'numeric', 'min:0'],
        ]);

        $funcion = Funcion::findOrFail($id);
        $funcion->fecha = $validated['fecha'];
        $funcion->sala_id = $validated['sala_id'];
        $funcion->pelicula_id = $validated['pelicula_id'];
        $funcion->tipo = $validated['tipo'];
        $funcion->costo = $validated['costo'];
        $funcion->save();

        return redirect()->route('funciones.index');
    }

    public function delete($id)
    {
        $funcion = Funcion::find($id);
        if ($funcion) {
            $funcion->delete();
        }
        return redirect()->back();
    }
}
