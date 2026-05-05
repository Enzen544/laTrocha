<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiado extends Model
{
    protected $fillable = [
        'entidad_id',
        'tipo',
        'tipo_registro',
        'monto',
        'galones',
        'descripcion',
        'user_id',
    ];

    // Pertenece a una entidad (cliente)
    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    // Quién lo registró
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}