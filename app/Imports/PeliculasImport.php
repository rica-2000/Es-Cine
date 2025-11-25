<?php

namespace App\Imports;

use App\Models\pelicula as Pelicula;
use Maatwebsite\Excel\Concerns\ToModel;

class PeliculasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pelicula([
            'title'     => $row[0] ?? null,
            'genre'     => $row[1] ?? null,
            'duration'  => isset($row[2]) ? (int) $row[2] : null,
            'director'  => $row[3] ?? null,
        ]);
    }
}
