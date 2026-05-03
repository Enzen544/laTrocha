<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CombustibleRegistro;
use App\Models\Fiado;
use App\Models\Lavada;
use App\Models\MovimientoBodega;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->get('tipo', 'diario');

        [$fechaInicio, $fechaFin] = $this->getRango($tipo, $request);

        $datos = $this->getDatos($fechaInicio, $fechaFin);

        return view('reportes.index', compact('datos', 'tipo', 'fechaInicio', 'fechaFin'));
    }

    public function exportPdf(Request $request)
    {
        $tipo = $request->get('tipo', 'diario');
        [$fechaInicio, $fechaFin] = $this->getRango($tipo, $request);
        $datos = $this->getDatos($fechaInicio, $fechaFin);

        return view('reportes.pdf', compact('datos', 'tipo', 'fechaInicio', 'fechaFin'));
    }

    public function exportExcel(Request $request)
    {
        $tipo = $request->get('tipo', 'diario');
        [$fechaInicio, $fechaFin] = $this->getRango($tipo, $request);
        $datos = $this->getDatos($fechaInicio, $fechaFin);

        $filename = "reporte_{$tipo}_{$fechaInicio}.csv";

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($datos, $tipo, $fechaInicio, $fechaFin) {
            $out = fopen('php://output', 'w');

            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, ['REPORTE ' . strtoupper($tipo) . ' - ESTACIÓN LA TROCHA'], ';');
            fputcsv($out, ['Período:', $fechaInicio . ' al ' . $fechaFin], ';');
            fputcsv($out, [], ';');

            fputcsv($out, ['COMBUSTIBLE', '', ''], ';');
            fputcsv($out, ['Concepto', 'Litros', 'Total COP'], ';');
            fputcsv($out, ['Gasolina Corriente', number_format($datos['gasolina_litros'], 2), $datos['gasolina_total']], ';');
            fputcsv($out, ['ACPM',               number_format($datos['acpm_litros'], 2),     $datos['acpm_total']], ';');
            fputcsv($out, ['TOTAL COMBUSTIBLE',  '',                                           $datos['combustible_total']], ';');
            fputcsv($out, [], ';');

            fputcsv($out, ['FIADOS', '', ''], ';');
            fputcsv($out, ['Concepto', 'Clientes', 'Total COP'], ';');
            fputcsv($out, ['Deuda pendiente total', $datos['fiados_clientes'], $datos['fiados_pendientes']], ';');
            fputcsv($out, ['Abonos del período',    '',                        $datos['fiados_abonos']], ';');
            fputcsv($out, [], ';');

            fputcsv($out, ['LAVADAS', '', ''], ';');
            fputcsv($out, ['Concepto', 'Servicios', 'Total COP'], ';');
            fputcsv($out, ['Total lavadas',      $datos['lavadas_count'], $datos['lavadas_total']], ';');
            fputcsv($out, ['Pendientes de cobro', '',                      $datos['lavadas_pendientes']], ';');
            fputcsv($out, [], ';');

            fputcsv($out, ['BODEGA', '', ''], ';');
            fputcsv($out, ['Concepto', 'Movimientos', 'Total COP'], ';');
            fputcsv($out, ['Ventas bodega', $datos['bodega_movimientos'], $datos['bodega_total']], ';');
            fputcsv($out, [], ';');

            fputcsv($out, ['GRAN TOTAL DEL PERÍODO', '', $datos['gran_total']], ';');

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getRango(string $tipo, Request $request): array
    {
        return match ($tipo) {
            'semanal' => [
                Carbon::now()->startOfWeek()->toDateString(),
                Carbon::now()->endOfWeek()->toDateString(),
            ],
            'mensual' => [
                Carbon::now()->startOfMonth()->toDateString(),
                Carbon::now()->endOfMonth()->toDateString(),
            ],
            default => [
                Carbon::today()->toDateString(),
                Carbon::today()->toDateString(),
            ],
        };
    }

    private function getDatos(string $fechaInicio, string $fechaFin): array
    {
        $combustible = CombustibleRegistro::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();

        $gasolina = $combustible->where('tipo', 'gasolina');
        $acpm     = $combustible->where('tipo', 'acpm');

        $fiadosPendientes = Fiado::where('estado', 'pendiente')->get();
        $fiadosPagados   = Fiado::where('estado', 'pagado')
            ->whereBetween('fecha_pago', [$fechaInicio, $fechaFin])
            ->get();

        $lavadas = Lavada::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();

        $bodega = MovimientoBodega::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('tipo', 'salida')
            ->get();

        return [
            'gasolina_litros'  => $gasolina->sum('diferencia'),
            'gasolina_total'   => $gasolina->sum('total'),
            'acpm_litros'      => $acpm->sum('diferencia'),
            'acpm_total'       => $acpm->sum('total'),
            'combustible_total' => $combustible->sum('total'),
            'combustible_registros' => $combustible,

            'fiados_pendientes'     => $fiadosPendientes->sum('monto'),
            'fiados_clientes'       => $fiadosPendientes->groupBy('entidad_id')->count(),
            'fiados_abonos'         => $fiadosPagados->sum('monto'),

            'lavadas_total'    => $lavadas->sum('valor'),
            'lavadas_count'    => $lavadas->count(),
            'lavadas_pendientes' => $lavadas->where('estado', 'pendiente')->sum('valor'),
            'lavadas_detalle'  => $lavadas,

            'bodega_total'     => $bodega->sum(fn($m) => $m->cantidad * $m->precio_unitario),
            'bodega_movimientos' => $bodega->count(),


            'gran_total' => $combustible->sum('total')
                + $lavadas->where('estado', 'cancelado')->sum('valor')
                + $bodega->sum(fn($m) => $m->cantidad * $m->precio_unitario),
        ];
    }
}
