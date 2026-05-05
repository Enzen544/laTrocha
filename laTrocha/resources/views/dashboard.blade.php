<x-app-layout>
    <x-slot name="pageTitle">Estación de Servicio "La Trocha"</x-slot>
    <x-slot name="pageSubtitle">Biomax S.A. · Campohermoso, Boyacá</x-slot>

    <style>
        .welcome-bar {
            background: linear-gradient(135deg, #0F6E56 0%, #1D9E75 100%);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            color: #fff
        }

        .welcome-title {
            font-size: 1.2rem;
            font-weight: 600
        }

        .welcome-sub {
            font-size: .82rem;
            color: rgba(255, 255, 255, .7);
            margin-top: 3px
        }

        .welcome-badge {
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: .78rem;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .welcome-dot {
            width: 7px;
            height: 7px;
            background: #5DCAA5;
            border-radius: 50%;
            animation: pulse 2s infinite
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: .5;
                transform: scale(.85)
            }
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem
        }

        .kpi-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #E8EAED;
            padding: 1.2rem 1.4rem;
            display: flex;
            flex-direction: column;
            gap: .5rem
        }

        .kpi-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start
        }

        .kpi-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .kpi-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round
        }

        .kpi-icon.green {
            background: #E1F5EE;
            stroke: #0F6E56
        }

        .kpi-icon.green svg {
            stroke: #0F6E56
        }

        .kpi-icon.blue {
            background: #EBF3FF
        }

        .kpi-icon.blue svg {
            stroke: #2563EB
        }

        .kpi-icon.orange {
            background: #FEF3E2
        }

        .kpi-icon.orange svg {
            stroke: #D97706
        }

        .kpi-icon.red {
            background: #FCEBEB
        }

        .kpi-icon.red svg {
            stroke: #DC2626
        }

        .kpi-change {
            font-size: .72rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px
        }

        .kpi-change.up {
            background: #E1F5EE;
            color: #0F6E56
        }

        .kpi-change.down {
            background: #FCEBEB;
            color: #DC2626
        }

        .kpi-change.neutral {
            background: #F4F6F8;
            color: #666
        }

        .kpi-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1
        }

        .kpi-label {
            font-size: .75rem;
            color: #999;
            font-weight: 400
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem
        }

        .chart-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #E8EAED;
            padding: 1.4rem
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.2rem
        }

        .chart-title {
            font-size: .95rem;
            font-weight: 600;
            color: #1a1a1a
        }

        .chart-sub {
            font-size: .75rem;
            color: #999;
            margin-top: 2px
        }

        .chart-legend {
            display: flex;
            gap: 12px
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: .72rem;
            color: #666
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #F4F6F8
        }

        .list-item:last-child {
            border-bottom: none
        }

        .list-left {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .list-avatar {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #E1F5EE;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            color: #0F6E56;
            flex-shrink: 0
        }

        .list-name {
            font-size: .83rem;
            font-weight: 500;
            color: #1a1a1a
        }

        .list-sub {
            font-size: .72rem;
            color: #999
        }

        .list-amount {
            font-size: .85rem;
            font-weight: 600
        }

        .list-amount.red {
            color: #DC2626
        }

        .list-amount.green {
            color: #0F6E56
        }

        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .75rem;
            margin-top: 1rem
        }

        .quick-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1.5px solid #E8EAED;
            background: #fff;
            cursor: pointer;
            text-decoration: none;
            transition: all .15s;
            color: #1a1a1a
        }

        .quick-btn:hover {
            border-color: #0F6E56;
            background: #E1F5EE
        }

        .quick-btn svg {
            width: 18px;
            height: 18px;
            stroke: #0F6E56;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0
        }

        .quick-btn-text {
            font-size: .82rem;
            font-weight: 500
        }

        .quick-btn-sub {
            font-size: .7rem;
            color: #999
        }

        .empty-mini {
            text-align: center;
            padding: 1.5rem;
            color: #bbb;
            font-size: .82rem
        }
    </style>

    <div class="welcome-bar">
        <div>
            <p class="welcome-title">¡Bienvenido, {{ explode(' ', Auth::user()->name)[0] }}! ¿Qué quieres hacer hoy?</p>
            <p class="welcome-sub">{{ now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
        </div>
        <div class="welcome-badge">
            <span class="welcome-dot"></span>
            Sistema activo
        </div>
    </div>

    @php
        $hoy = \Carbon\Carbon::today()->toDateString();
        $semanaInicio = \Carbon\Carbon::now()->startOfWeek()->toDateString();
        $semanaFin = \Carbon\Carbon::now()->endOfWeek()->toDateString();

        $combustibleHoy = \App\Models\CombustibleRegistro::where('fecha', $hoy)->get();
        $totalCombustibleHoy = $combustibleHoy->sum('total');
        $galonesHoy = $combustibleHoy->sum('galones_vendidos');

        $fiadosPendientes = \App\Models\Fiado::where('estado', 'pendiente')->sum('monto');
        $fiadosClientes = \App\Models\Fiado::where('estado', 'pendiente')->distinct('entidad_id')->count('entidad_id');

        $bodegaMovimientos = \App\Models\MovimientoBodega::where('fecha', $hoy)->count();
        $bodegaProductos = \App\Models\Producto::where('activo', true)->count();

        $ultFiados = \App\Models\Fiado::with('entidad')->where('estado', 'pendiente')->latest()->take(5)->get();

        $semana = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dia = \Carbon\Carbon::today()->subDays($i);
            $semana->push([
                'dia' => $dia->locale('es')->isoFormat('ddd'),
                'total' => \App\Models\CombustibleRegistro::where('fecha', $dia->toDateString())->sum('total'),
            ]);
        }
        $maxSemana = $semana->max('total') ?: 1;

        $gasolinaHoy = $combustibleHoy->where('tipo', 'gasolina')->sum('total');
        $acpmHoy = $combustibleHoy->where('tipo', 'acpm')->sum('total');
    @endphp

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-icon green">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 22V8l6-6h8l4 4v16" />
                        <path d="M3 12h18" />
                        <path d="M15 22v-5a2 2 0 00-2-2h-2a2 2 0 00-2 2v5" />
                    </svg>
                </div>
                <span class="kpi-change {{ $totalCombustibleHoy > 0 ? 'up' : 'neutral' }}">
                    {{ $galonesHoy > 0 ? number_format($galonesHoy, 2) . ' gal' : 'Sin datos' }}
                </span>
            </div>
            <div class="kpi-value">${{ number_format($totalCombustibleHoy, 0, ',', '.') }}</div>
            <div class="kpi-label">Combustible hoy</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-icon red">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 00-3-3.87" />
                        <path d="M16 3.13a4 4 0 010 7.75" />
                    </svg>
                </div>
                <span class="kpi-change {{ $fiadosPendientes > 0 ? 'down' : 'up' }}">
                    {{ $fiadosClientes }} {{ $fiadosClientes === 1 ? 'cliente' : 'clientes' }}
                </span>
            </div>
            <div class="kpi-value" style="color:#DC2626">${{ number_format($fiadosPendientes, 0, ',', '.') }}</div>
            <div class="kpi-label">Fiados pendientes</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-icon orange">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                    </svg>
                </div>
                <span class="kpi-change neutral">{{ $bodegaMovimientos }} movimientos</span>
            </div>
            <div class="kpi-value">{{ $bodegaProductos }}</div>
            <div class="kpi-label">Productos en bodega</div>
        </div>
    </div>

    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <p class="chart-title">Ventas de Combustible — Últimos 7 días</p>
                    <p class="chart-sub">Gasolina + ACPM en pesos</p>
                </div>
                <div class="chart-legend">
                    <div class="legend-item"><span class="legend-dot" style="background:#0F6E56"></span>Total</div>
                </div>
            </div>
            <div style="display:flex;align-items:flex-end;gap:8px;height:140px;padding-bottom:24px;position:relative">
                @foreach ($semana as $d)
                    @php $h = $maxSemana > 0 ? ($d['total'] / $maxSemana) * 100 : 0; @endphp
                    <div
                        style="flex:1;display:flex;flex-direction:column;align-items:center;gap:4px;height:100%;justify-content:flex-end">
                        <span style="font-size:.65rem;color:#0F6E56;font-weight:600">
                            {{ $d['total'] > 0 ? '$' . number_format($d['total'] / 1000, 0) . 'k' : '' }}
                        </span>
                        <div
                            style="width:100%;background:{{ $d['dia'] === now()->locale('es')->isoFormat('ddd') ? '#0F6E56' : '#E1F5EE' }};border-radius:6px 6px 0 0;height:{{ max(4, $h) }}%;transition:height .3s">
                        </div>
                        <span style="font-size:.68rem;color:#999;text-transform:capitalize">{{ $d['dia'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <p class="chart-title">Distribución Hoy</p>
                    <p class="chart-sub">Corriente vs ACPM</p>
                </div>
            </div>
            @php
                $total = $gasolinaHoy + $acpmHoy ?: 1;
                $pctGas = round(($gasolinaHoy / $total) * 100);
                $pctAcpm = 100 - $pctGas;
            @endphp
            <div style="display:flex;flex-direction:column;gap:1rem;margin-top:.5rem">
                <div>
                    <div style="display:flex;justify-content:space-between;font-size:.78rem;margin-bottom:5px">
                        <span style="color:#2563EB;font-weight:500">Gasolina Corriente</span>
                        <span style="font-weight:600">{{ $pctGas }}%</span>
                    </div>
                    <div style="background:#EBF3FF;border-radius:6px;height:10px">
                        <div style="background:#2563EB;border-radius:6px;height:100%;width:{{ $pctGas }}%"></div>
                    </div>
                    <div style="font-size:.72rem;color:#999;margin-top:3px">
                        ${{ number_format($gasolinaHoy, 0, ',', '.') }}</div>
                </div>
                <div>
                    <div style="display:flex;justify-content:space-between;font-size:.78rem;margin-bottom:5px">
                        <span style="color:#0F6E56;font-weight:500">ACPM</span>
                        <span style="font-weight:600">{{ $pctAcpm }}%</span>
                    </div>
                    <div style="background:#E1F5EE;border-radius:6px;height:10px">
                        <div style="background:#0F6E56;border-radius:6px;height:100%;width:{{ $pctAcpm }}%"></div>
                    </div>
                    <div style="font-size:.72rem;color:#999;margin-top:3px">${{ number_format($acpmHoy, 0, ',', '.') }}
                    </div>
                </div>
                <div style="border-top:1px solid #F4F6F8;padding-top:.8rem;display:flex;justify-content:space-between">
                    <span style="font-size:.78rem;color:#666">Total del día</span>
                    <span
                        style="font-size:.88rem;font-weight:700;color:#0F6E56">${{ number_format($gasolinaHoy + $acpmHoy, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <p class="chart-title">Fiados Pendientes</p>
                    <p class="chart-sub">Clientes con deuda activa</p>
                </div>
                <a href="{{ route('fiados.index') }}"
                    style="font-size:.75rem;color:#0F6E56;text-decoration:none;font-weight:500">Ver todos →</a>
            </div>
            @if ($ultFiados->isEmpty())
                <div class="empty-mini">Sin fiados pendientes</div>
            @else
                @foreach ($ultFiados as $f)
                    <div class="list-item">
                        <div class="list-left">
                            <div class="list-avatar">{{ strtoupper(substr($f->entidad->nombre ?? 'N', 0, 2)) }}</div>
                            <div>
                                <p class="list-name">{{ $f->entidad->nombre ?? 'Sin nombre' }}</p>
                                <p class="list-sub">{{ \Carbon\Carbon::parse($f->fecha)->format('d/m/Y') }} ·
                                    {{ ucfirst($f->tipo_combustible) }}</p>
                            </div>
                        </div>
                        <span class="list-amount red">${{ number_format($f->monto, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <p class="chart-title">Acciones Rápidas</p>
                    <p class="chart-sub">Accesos directos</p>
                </div>
            </div>
            <div class="quick-actions">
                <a href="{{ route('combustible.index', ['tipo' => 'gasolina']) }}" class="quick-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 22V8l6-6h8l4 4v16" />
                        <path d="M3 12h18" />
                    </svg>
                    <div>
                        <div class="quick-btn-text">Combustible</div>
                        <div class="quick-btn-sub">Nuevo registro</div>
                    </div>
                </a>
                <a href="{{ route('fiados.index') }}" class="quick-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                    </svg>
                    <div>
                        <div class="quick-btn-text">Fiados</div>
                        <div class="quick-btn-sub">Gestionar</div>
                    </div>
                </a>
                <a href="{{ route('bodega.index') }}" class="quick-btn">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                    </svg>
                    <div>
                        <div class="quick-btn-text">Bodega</div>
                        <div class="quick-btn-sub">Inventario</div>
                    </div>
                </a>
                <a href="{{ route('reportes.index') }}" class="quick-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                    </svg>
                    <div>
                        <div class="quick-btn-text">Reportes</div>
                        <div class="quick-btn-sub">Ver análisis</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
