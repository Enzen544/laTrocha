<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table = 'entidades';

    protected $fillable = [
        'nombre',
        'tipo',
        'contacto',
        'observacion',
        'activo',
    ];

    public function fiados()
    {
        return $this->hasMany(Fiado::class);
    }

    public function getDeudaTotalAttribute()
    {
        $fiados = $this->fiados()->where('tipo', 'fiado')->sum('monto');
        $abonos = $this->fiados()->where('tipo', 'abono')->sum('monto');
        return $fiados - $abonos;
    }
}