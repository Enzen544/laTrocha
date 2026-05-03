<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteExport implements FromArray, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(
        private array  $datos,
        private string $tipo,
        private string $fechaInicio,
        private string $fechaFin,
    ) {}

    public function title(): string
    {
        return 'Reporte ' . ucfirst($this->tipo);
    }

    public function headings(): array
    {
        return ['Concepto', 'Detalle', 'Valor (COP)'];
    }

    public function array(): array
    {
        $d = $this->datos;

        return [
            ['COMBUSTIBLE', '', ''],
            ['Gasolina corriente', number_format($d['gasolina_litros'], 2) . ' litros', '$' . number_format($d['gasolina_total'], 0, ',', '.')],
            ['ACPM',               number_format($d['acpm_litros'], 2)     . ' litros', '$' . number_format($d['acpm_total'], 0, ',', '.')],
            ['Total combustible',  '',                                                   '$' . number_format($d['combustible_total'], 0, ',', '.')],
            ['', '', ''],
            ['FIADOS', '', ''],
            ['Fiados del período', '',   '$' . number_format($d['fiados_periodo'], 0, ',', '.')],
            ['Deuda pendiente',    $d['fiados_clientes'] . ' clientes', '$' . number_format($d['fiados_pendientes'], 0, ',', '.')],
            ['Abonos recibidos',   '',   '$' . number_format($d['fiados_abonos'], 0, ',', '.')],
            ['', '', ''],
            ['LAVADAS', '', ''],
            ['Total lavadas',      $d['lavadas_count'] . ' servicios', '$' . number_format($d['lavadas_total'], 0, ',', '.')],
            ['Pendientes de cobro', '',   '$' . number_format($d['lavadas_pendientes'], 0, ',', '.')],
            ['', '', ''],
            ['BODEGA', '', ''],
            ['Ventas bodega',      $d['bodega_movimientos'] . ' movimientos', '$' . number_format($d['bodega_total'], 0, ',', '.')],
            ['', '', ''],
            ['GRAN TOTAL',         '',   '$' . number_format($d['gran_total'], 0, ',', '.')],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1  => ['font' => ['bold' => true]],
            2  => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'E1F5EE']]],
            6  => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'E1F5EE']]],
            11 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'E1F5EE']]],
            15 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'E1F5EE']]],
            18 => ['font' => ['bold' => true, 'size' => 13], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '0F6E56']], 'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 30, 'B' => 25, 'C' => 20];
    }
}
