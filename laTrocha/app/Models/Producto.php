<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'categoria',
        'precio_compra',
        'precio_venta',
        'stock_actual',
        'stock_minimo',
        'activo',
    ];

    public function movimientos()
    {
        return $this->hasMany(MovimientoBodega::class);
    }

    public function getStockBajoAttribute()
    {
        return $this->stock_actual <= $this->stock_minimo;
    }
}