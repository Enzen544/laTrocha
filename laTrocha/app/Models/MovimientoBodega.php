<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoBodega extends Model
{
    protected $table = 'movimientos_bodega';

    protected $fillable = [
        'producto_id',
        'tipo',
        'cantidad',
        'descripcion',
        'user_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}