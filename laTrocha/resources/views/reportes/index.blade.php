<x-app-layout>
    <x-slot name="pageTitle">Reportes</x-slot>
    <x-slot name="pageSubtitle">Análisis y estadísticas operativas</x-slot>

    <style>
        .tabs { display:flex; background:#fff; border-radius:12px; padding:4px; border:1px solid #E8EAED; margin-bottom:1.5rem; }
        .tab { flex:1; padding:10px; text-align:center; border-radius:9px; font-size:.88rem; font-weight:500; cursor:pointer; color:#888; border:none; background:none; transition:all .15s; }
        .tab.active { background:#0F6E56; color:#fff; }
        .tab:hover:not(.active) { background:#f4f6f8; color:#333; }
        .export-bar { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; }
        .period-label { display:flex; align-items:center; gap:8px; font-size:.85rem; color:#666; }
        .period-label svg { width:16px; height:16px; stroke:#0F6E56; fill:none; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
        .export-btns { display:flex; gap:8px; }
        .btn-export { display:flex; align-items:center; gap:6px; padding:8px 16px; border-radius:9px; font-size:.82rem; font-weight:500; cursor:pointer; text-decoration:none; border:1.5px solid; transition:all .15s; }
        .btn-pdf { color:#A32D2D; border-color:#F7C1C1; background:#FCEBEB; }
        .btn-pdf:hover { background:#f7c1c1; }
        .btn-excel { color:#27500A; border-color:#C0DD97; background:#EAF3DE; }
        .btn-excel:hover { background:#c0dd97; }
        .btn-export svg { width:14px; height:14px; stroke:currentColor; fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }
        .card { background:#fff; border-radius:14px; border:1px solid #E8EAED; padding:1.5rem; margin-bottom:1.2rem; }
        .card-title { font-size:1rem; font-weight:600; color:#1a1a1a; }
        .card-sub { font-size:.78rem; color:#999; margin-top:2px; margin-bottom:1.2rem; }
        .two-col { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem; }
        .stat-box { border:1px solid #E8EAED; border-radius:10px; padding:1rem; }
        .stat-label { font-size:.75rem; color:#999; display:flex; align-items:center; gap:6px; margin-bottom:.5rem; }
        .stat-dot { width:8px; height:8px; border-radius:50%; }
        .stat-dot.blue { background:#378ADD; }
        .stat-dot.green { background:#1D9E75; }
        .stat-value { font-size:1.6rem; font-weight:700; color:#1a1a1a; }
        .stat-sub { font-size:.75rem; color:#aaa; margin-top:3px; }
        .total-row { display:flex; justify-content:space-between; align-items:center; padding:1rem 0; border-top:1px solid #f0f0f0; }
        .total-row .label { font-weight:600; font-size:.95rem; }
        .total-row .value { font-size:1.3rem; font-weight:700; color:#1a1a1a; }
        .indicator-row { display:flex; justify-content:space-between; align-items:center; padding:12px 14px; border-radius:9px; background:#F9FAFB; margin-bottom:6px; }
        .indicator-left { display:flex; align-items:center; gap:8px; font-size:.85rem; color:#333; }
        .indicator-left svg { width:16px; height:16px; stroke:#0F6E56; fill:none; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
        .indicator-value { font-size:.9rem; font-weight:600; color:#1a1a1a; }
        .fiados-red { color:#E24B4A; font-weight:700; font-size:1.5rem; }
        .fiados-green2 { color:#1D9E75; font-weight:700; font-size:1.5rem; }
        .gran-total-box { background:#0F6E56; border-radius:14px; padding:1.5rem 2rem; display:flex; justify-content:space-between; align-items:center; }
        .gran-total-label { color:rgba(255,255,255,.8); font-size:.9rem; }
        .gran-total-value { color:#fff; font-size:2rem; font-weight:700; }
        .gran-total-period { color:rgba(255,255,255,.5); font-size:.75rem; margin-top:2px; }
        @keyframes spin { to { transform:rotate(360deg); } }
    </style>

    <div class="tabs">
        <a href="{{ route('reportes.index', ['tipo' => 'diario']) }}"  class="tab {{ $tipo === 'diario'  ? 'active' : '' }}">Diario</a>
        <a href="{{ route('reportes.index', ['tipo' => 'semanal']) }}" class="tab {{ $tipo === 'semanal' ? 'active' : '' }}">Semanal</a>
        <a href="{{ route('reportes.index', ['tipo' => 'mensual']) }}" class="tab {{ $tipo === 'mensual' ? 'active' : '' }}">Mensual</a>
    </div>

    <div class="export-bar">
        <div class="period-label">
            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            @if ($tipo === 'diario')
                Hoy · {{ \Carbon\Carbon::parse($fechaInicio)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
            @elseif($tipo === 'semanal')
                Semana · {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m') }} al {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
            @else
                {{ \Carbon\Carbon::parse($fechaInicio)->locale('es')->isoFormat('MMMM [de] YYYY') }}
            @endif
        </div>
        <div class="export-btns">
            <a href="{{ route('reportes.pdf', ['tipo' => $tipo]) }}" class="btn-export btn-pdf" target="_blank" onclick="mostrarCargando('Generando PDF...')">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                <span>Exportar PDF</span>
            </a>
            <a href="{{ route('reportes.excel', ['tipo' => $tipo]) }}" class="btn-export btn-excel" onclick="mostrarCargando('Generando Excel...')">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>
                <span>Exportar Excel</span>
            </a>
        </div>
    </div>

    <div id="overlay-carga" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:9999; align-items:center; justify-content:center;">
        <div style="background:#fff; border-radius:16px; padding:2rem 3rem; text-align:center; box-shadow:0 8px 32px rgba(0,0,0,0.18);">
            <div style="width:48px; height:48px; border:4px solid #E1F5EE; border-top:4px solid #0F6E56; border-radius:50%; animation:spin 0.8s linear infinite; margin:0 auto 1rem;"></div>
            <p id="overlay-texto" style="font-size:1rem; font-weight:600; color:#0F6E56; margin:0;">Generando...</p>
            <p style="font-size:.8rem; color:#aaa; margin-top:.4rem;">Esto puede tomar unos segundos</p>
        </div>
    </div>

    <div class="card">
        <p class="card-title">Resumen de Combustible</p>
        <p class="card-sub">Ventas y diferencias del período</p>
        <div class="two-col">
            <div class="stat-box">
                <div class="stat-label"><span class="stat-dot blue"></span> Gasolina Corriente</div>
                <div class="stat-value">${{ number_format($datos['gasolina_total'], 0, ',', '.') }}</div>
                <div class="stat-sub">{{ number_format($datos['gasolina_litros'], 2) }} litros</div>
            </div>
            <div class="stat-box">
                <div class="stat-label"><span class="stat-dot green"></span> ACPM</div>
                <div class="stat-value">${{ number_format($datos['acpm_total'], 0, ',', '.') }}</div>
                <div class="stat-sub">{{ number_format($datos['acpm_litros'], 2) }} litros</div>
            </div>
        </div>
        <div class="total-row">
            <span class="label">Total Vendido</span>
            <span class="value">${{ number_format($datos['combustible_total'], 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="card">
        <p class="card-title">Resumen de Fiados</p>
        <p class="card-sub">Estado de cartera</p>
        <div class="two-col">
            <div class="stat-box">
                <div class="stat-label">Deuda Total Pendiente</div>
                <div class="fiados-red">${{ number_format($datos['fiados_pendientes'], 0, ',', '.') }}</div>
                <div class="stat-sub">{{ $datos['fiados_clientes'] }} clientes</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Abonos del Período</div>
                <div class="fiados-green2">${{ number_format($datos['fiados_abonos'], 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <p class="card-title">Indicadores Clave</p>
        <p class="card-sub" style="margin-bottom:.8rem">Métricas del período seleccionado</p>

        <div class="indicator-row">
            <div class="indicator-left">
                <svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                Ingresos Totales (Combustible)
            </div>
            <span class="indicator-value">${{ number_format($datos['combustible_total'], 0, ',', '.') }}</span>
        </div>

        <div class="indicator-row">
            <div class="indicator-left">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Registros de Combustible
            </div>
            <span class="indicator-value">{{ $datos['combustible_registros']->count() }}</span>
        </div>

        <div class="indicator-row">
            <div class="indicator-left">
                <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
                Movimientos Bodega
            </div>
            <span class="indicator-value">{{ $datos['bodega_movimientos'] }}</span>
        </div>
    </div>

    <div class="gran-total-box">
        <div>
            <p class="gran-total-label">Gran Total del Período</p>
            <p class="gran-total-period">
                {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }}
                @if ($fechaInicio !== $fechaFin)
                    — {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
                @endif
            </p>
        </div>
        <div class="gran-total-value">${{ number_format($datos['gran_total'], 0, ',', '.') }}</div>
    </div>

    <script>
    function mostrarCargando(texto) {
        const overlay = document.getElementById('overlay-carga');
        document.getElementById('overlay-texto').textContent = texto;
        overlay.style.display = 'flex';
        setTimeout(() => { overlay.style.display = 'none'; }, 15000);
    }
    </script>

</x-app-layout>