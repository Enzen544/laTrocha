<?php
namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\Fiado;
use Illuminate\Http\Request;

class FiadoController extends Controller
{
    // Lista todas las entidades con su deuda total
    public function index()
    {
        $entidades = Entidad::where('activo', true)
            ->with('fiados')
            ->get()
            ->map(function ($entidad) {
                return [
                    'id'          => $entidad->id,
                    'nombre'      => $entidad->nombre,
                    'tipo'        => $entidad->tipo,
                    'deuda_total' => $entidad->deuda_total,
                ];
            });

        return view('fiados', compact('entidades'));
    }

    // Crea una nueva entidad (cliente)
    public function storeEntidad(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo'   => 'required|in:persona,entidad',
        ]);

        $entidad = Entidad::create([
            'nombre' => $request->nombre,
            'tipo'   => $request->tipo,
            'activo' => true,
        ]);

        return response()->json($entidad, 201);
    }

    // Registra un fiado o abono
    public function store(Request $request)
    {
        $request->validate([
            'entidad_id'    => 'required|exists:entidades,id',
            'tipo'          => 'required|in:fiado,abono',
            'tipo_registro' => 'required|in:pesos,galones',
            'monto'         => 'required|numeric|min:0.01',
            'galones'       => 'nullable|numeric|min:0.01',
            'descripcion'   => 'nullable|string|max:255',
        ]);

        $fiado = Fiado::create([
            'entidad_id'    => $request->entidad_id,
            'tipo'          => $request->tipo,
            'tipo_registro' => $request->tipo_registro,
            'monto'         => $request->monto,
            'galones'       => $request->galones,
            'descripcion'   => $request->descripcion,
            'user_id'       => auth()->id(),
        ]);

        return response()->json($fiado, 201);
    }

    // Elimina una entidad
    public function destroy(string $id)
    {
        $entidad = Entidad::findOrFail($id);
        $entidad->update(['activo' => false]);

        return response()->json(['message' => 'Entidad eliminada']);
    }
}