<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\funcion;
use App\Models\sala;

class adminController extends Controller
{
    public function generarReportePeliculasSalas(Request $request)
    {
        $validated = $request->validate([
            'sala_id' => ['required', 'integer', 'exists:salas,id'],
        ]);
        $salaId = $validated['sala_id'];
        $funciones = funcion::with(['sala', 'pelicula'])
            ->where('sala_id', $salaId)
            ->orderBy('id')
            ->get();
        $html = view('reportespeliculassalas', compact('funciones'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('peliculas_por_sala.pdf', ['Attachment' => true]);
    }

    public function dashboard()
    {
        $salas = sala::orderBy('nombre')->get(['id', 'nombre']);
        return view('dashboard', compact('salas'));
    }
}
