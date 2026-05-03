<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoBodega extends Model
{
    protected $table = 'movimientos_bodega';

    protected $fillable = [
        'fecha',
        'tipo',
        'cantidad',
        'precio_unitario',
        'descripcion',
    ];
}