<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CombustibleRegistro extends Model
{
    protected $fillable = [
        'tipo', 'fecha', 'lectura_anterior', 'lectura_actual',
        'diferencia', 'fiados_galones', 'galones_vendidos',
        'precio_unitario', 'total', 'efectivo_recaudado',
        'diferencia_pesos', 'user_id',
    ];
}
