<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte {{ ucfirst($tipo) }} · La Trocha</title>
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family: Arial, sans-serif; font-size:11px; color:#1a1a1a; background:#fff; }
        .header { background:#0F6E56; color:#fff; padding:20px 24px; margin-bottom:20px; }
        .header h1 { font-size:18px; font-weight:bold; }
        .header p { font-size:10px; color:rgba(255,255,255,.7); margin-top:3px; }
        .section { margin-bottom:18px; padding:0 24px; }
        .section-title { font-size:12px; font-weight:bold; color:#0F6E56; border-bottom:1.5px solid #0F6E56; padding-bottom:4px; margin-bottom:10px; }
        table { width:100%; border-collapse:collapse; }
        th { background:#E1F5EE; color:#085041; font-size:10px; padding:6px 10px; text-align:left; }
        td { padding:6px 10px; border-bottom:1px solid #f0f0f0; font-size:10px; }
        .text-right { text-align:right; }
        .bold { font-weight:bold; }
        .gran-total { background:#0F6E56; color:#fff; padding:14px 24px; margin-top:20px; }
        .gran-total-label { font-size:10px; color:rgba(255,255,255,.7); }
        .gran-total-value { font-size:20px; font-weight:bold; margin-top:2px; }
        .footer { text-align:center; font-size:9px; color:#aaa; margin-top:24px; border-top:1px solid #eee; padding-top:10px; }
        @media print {
            .no-print { display:none; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Reporte {{ ucfirst($tipo) }} · Estación La Trocha</h1>
        <p>Biomax S.A. · Campohermoso, Boyacá</p>
        <p>Período: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }}
            @if($fechaInicio !== $fechaFin) — {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }} @endif
            · Generado el {{ now()->format('d/m/Y H:i') }}
        </p>
    </div>

    <div class="section">
        <div class="section-title">Control de Combustible</div>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th class="text-right">Litros</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gasolina Corriente</td>
                    <td class="text-right">{{ number_format($datos['gasolina_litros'], 2) }}</td>
                    <td class="text-right bold">${{ number_format($datos['gasolina_total'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>ACPM</td>
                    <td class="text-right">{{ number_format($datos['acpm_litros'], 2) }}</td>
                    <td class="text-right bold">${{ number_format($datos['acpm_total'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="bold">Total Combustible</td>
                    <td></td>
                    <td class="text-right bold">${{ number_format($datos['combustible_total'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Fiados y Cartera</div>
        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th class="text-right">Clientes</th>
                    <th class="text-right">Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Deuda pendiente total</td>
                    <td class="text-right">{{ $datos['fiados_clientes'] }}</td>
                    <td class="text-right bold" style="color:#A32D2D">${{ number_format($datos['fiados_pendientes'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Abonos del período</td>
                    <td></td>
                    <td class="text-right bold" style="color:#0F6E56">${{ number_format($datos['fiados_abonos'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Lavadas</div>
        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th class="text-right">Servicios</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total cobrado</td>
                    <td class="text-right">{{ $datos['lavadas_count'] }}</td>
                    <td class="text-right bold">${{ number_format($datos['lavadas_total'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Pendientes de cobro</td>
                    <td></td>
                    <td class="text-right" style="color:#BA7517">${{ number_format($datos['lavadas_pendientes'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Bodega</div>
        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th class="text-right">Movimientos</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ventas bodega</td>
                    <td class="text-right">{{ $datos['bodega_movimientos'] }}</td>
                    <td class="text-right bold">${{ number_format($datos['bodega_total'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gran-total">
        <div class="gran-total-label">GRAN TOTAL DEL PERÍODO</div>
        <div class="gran-total-value">${{ number_format($datos['gran_total'], 0, ',', '.') }}</div>
    </div>

    <div class="footer">
        Estación de Servicio La Trocha · Biomax S.A. · Campohermoso, Boyacá
    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>