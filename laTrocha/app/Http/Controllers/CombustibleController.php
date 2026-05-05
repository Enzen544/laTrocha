<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CombustibleRegistro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CombustibleController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->get('tipo', 'gasolina');

        $registros = CombustibleRegistro::where('tipo', $tipo)
            ->orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $hoy = Carbon::today()->toDateString();
        $totalesHoy = CombustibleRegistro::where('tipo', $tipo)
            ->where('fecha', $hoy)
            ->selectRaw('
                SUM(diferencia) as total_galones,
                SUM(fiados_galones) as total_fiados,
                SUM(galones_vendidos) as total_vendidos,
                SUM(total) as total_pesos,
                SUM(efectivo_recaudado) as total_efectivo
            ')
            ->first();

        return view('combustible.index', compact('tipo', 'registros', 'totalesHoy'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:gasolina,acpm',
            'fecha' => 'required|date',
            'lectura_anterior' => 'required|numeric|min:0',
            'lectura_actual' => 'required|numeric|min:0',
            'fiados_galones' => 'nullable|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'efectivo_recaudado' => 'nullable|numeric|min:0',
        ]);
       
        $diferencia = $request->lectura_anterior - $request->lectura_actual;
        $fiadosGalones = $request->fiados_galones ?? 0;
        $galonesVendidos = $diferencia - $fiadosGalones;
        $total = $galonesVendidos * $request->precio_unitario;
        $efectivo  = $request->efectivo_recaudado ?? 0;
        $diferenciaPesos = $efectivo - $total;

        CombustibleRegistro::create([
            'tipo'               => $request->tipo,
            'fecha'              => $request->fecha,
            'lectura_anterior'   => $request->lectura_anterior,
            'lectura_actual'     => $request->lectura_actual,
            'diferencia'         => $diferencia,
            'fiados_galones'     => $fiadosGalones,
            'galones_vendidos'   => $galonesVendidos,
            'precio_unitario'    => $request->precio_unitario,
            'total'              => $total,
            'efectivo_recaudado' => $efectivo,
            'diferencia_pesos'   => $diferenciaPesos,
            'user_id'            => Auth::id(),
        ]);

        return redirect()->route('combustible.index', ['tipo' => $request->tipo])
            ->with('success', 'Registro guardado correctamente.');
    }

    public function edit(string $id)
    {
        $registro = CombustibleRegistro::findOrFail($id);
        return view('combustible.edit', compact('registro'));
    }

    public function update(Request $request, string $id)
    {
        $registro = CombustibleRegistro::findOrFail($id);

        $request->validate([
            'lectura_anterior' => 'required|numeric|min:0',
            'lectura_actual' => 'required|numeric|min:0|gte:lectura_anterior',
            'fiados_galones' => 'nullable|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'efectivo_recaudado' => 'nullable|numeric|min:0',
        ]);

        $diferencia = $request->lectura_actual - $request->lectura_anterior;
        $fiadosGalones = $request->fiados_galones ?? 0;
        $galonesVendidos = $diferencia - $fiadosGalones;
        $total = $galonesVendidos * $request->precio_unitario;
        $efectivo = $request->efectivo_recaudado ?? 0;
        $diferenciaPesos = $efectivo - $total;

        $registro->update([
            'lectura_anterior' => $request->lectura_anterior,
            'lectura_actual' => $request->lectura_actual,
            'diferencia' => $diferencia,
            'fiados_galones' => $fiadosGalones,
            'galones_vendidos' => $galonesVendidos,
            'precio_unitario' => $request->precio_unitario,
            'total' => $total,
            'efectivo_recaudado' => $efectivo,
            'diferencia_pesos' => $diferenciaPesos,
        ]);

        return redirect()->route('combustible.index', ['tipo' => $registro->tipo])
            ->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $registro = CombustibleRegistro::findOrFail($id);
        $tipo = $registro->tipo;
        $registro->delete();

        return redirect()->route('combustible.index', ['tipo' => $tipo])
            ->with('success', 'Registro eliminado.');
    }
}
