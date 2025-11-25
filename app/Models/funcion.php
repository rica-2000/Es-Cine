<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class funcion extends Model
{
    use SoftDeletes;

    protected $table = 'funcions';

    protected $fillable = [
        'fecha', 'sala_id', 'pelicula_id', 'tipo', 'costo',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'costo' => 'decimal:2',
    ];

    public function sala()
    {
        return $this->belongsTo(sala::class);
    }

    public function pelicula()
    {
        return $this->belongsTo(pelicula::class);
    }
}
