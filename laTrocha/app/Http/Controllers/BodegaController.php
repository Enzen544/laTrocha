<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\MovimientoBodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    public function index()
    {
        $productos = Producto::where('activo', true)->get()->map(function ($p) {
            return [
                'id'            => $p->id,
                'nombre'        => $p->nombre,
                'categoria'     => $p->categoria,
                'precio_compra' => $p->precio_compra,
                'precio_venta'  => $p->precio_venta,
                'stock_actual'  => $p->stock_actual,
                'stock_minimo'  => $p->stock_minimo,
                'stock_bajo'    => $p->stock_bajo,
            ];
        });

        return view('bodega', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'categoria'     => 'nullable|string|max:255',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock_actual'  => 'required|integer|min:0',
            'stock_minimo'  => 'required|integer|min:0',
        ]);

        $producto = Producto::create($request->all());

        return response()->json($producto);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'categoria'     => 'nullable|string|max:255',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock_minimo'  => 'required|integer|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return response()->json($producto);
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update(['activo' => false]);

        return response()->json(['ok' => true]);
    }

    public function movimiento(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo'        => 'required|in:entrada,salida',
            'cantidad'    => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($request->tipo === 'salida' && $producto->stock_actual < $request->cantidad) {
            return response()->json(['error' => 'Stock insuficiente'], 422);
        }

        MovimientoBodega::create([
            'producto_id' => $request->producto_id,
            'tipo'        => $request->tipo,
            'cantidad'    => $request->cantidad,
            'descripcion' => $request->descripcion,
            'user_id'     => auth()->id(),
        ]);

        if ($request->tipo === 'entrada') {
            $producto->increment('stock_actual', $request->cantidad);
        } else {
            $producto->decrement('stock_actual', $request->cantidad);
        }

        return response()->json(['ok' => true, 'stock_actual' => $producto->fresh()->stock_actual]);
    }
}