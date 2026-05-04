<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>La Trocha · {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F4F6F8;
            display: flex;
            min-height: 100vh;
            color: #1a1a1a;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #0F6E56;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-logo {
            padding: 1.5rem 3.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo img {
            width: 90px;
           
        }

        .sidebar-station {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.6);
            margin-top: 0.4rem;
            letter-spacing: 0.04em;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1.2rem 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            padding: 0.8rem 0.75rem 0.3rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 400;
            transition: background 0.15s, color 0.15s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        .nav-item.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-weight: 500;
        }

        .nav-item svg {
            width: 18px; height: 18px;
            flex-shrink: 0;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .sidebar-footer {
            padding: 1rem 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 10px;
        }

        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info { flex: 1; min-width: 0; }

        .user-name {
            font-size: 0.82rem;
            font-weight: 500;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 9px 12px;
            margin-top: 6px;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
            border: none;
            color: rgba(255,255,255,0.7);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            cursor: pointer;
            text-align: left;
            transition: background 0.15s, color 0.15s;
        }

        .btn-logout:hover {
            background: rgba(255,80,80,0.2);
            color: #ff9999;
        }

        .btn-logout svg {
            width: 16px; height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .main-wrapper {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #E8EAED;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .topbar-sub {
            font-size: 0.78rem;
            color: #888;
            margin-top: 1px;
        }

        .topbar-date {
            font-size: 0.82rem;
            color: #666;
            background: #F4F6F8;
            padding: 6px 14px;
            border-radius: 8px;
        }

        .page-content {
            padding: 2rem;
            flex: 1;
        }

       
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/biomaxImage.png') }}" alt="Biomax">
        </div>
        <p class="sidebar-station" style="display: flex; justify-content:center">Estación La Trocha · Campohermoso</p>

        <nav class="sidebar-nav">
            <span class="nav-label">Principal</span>

            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>

            <span class="nav-label">Operaciones</span>

            <a href="{{ route('combustible.index') }}"
               class="nav-item {{ request()->routeIs('combustible.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M3 22V8l6-6h8l4 4v16"/><path d="M3 12h18"/><path d="M15 22v-5a2 2 0 00-2-2h-2a2 2 0 00-2 2v5"/></svg>
                Control de Combustible
            </a>

            <a href="{{ route('fiados.index') }}"
               class="nav-item {{ request()->routeIs('fiados.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Gestión de Fiados
            </a>

            <a href="{{ route('bodega.index') }}"
               class="nav-item {{ request()->routeIs('bodega.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                Inventario de Bodega
            </a>

            <a href="{{ route('lavadas.index') }}"
               class="nav-item {{ request()->routeIs('lavadas.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                Lavadas
            </a>

            <span class="nav-label">Informes</span>

            <a href="{{ route('reportes.index') }}"
               class="nav-item {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Reportes
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="user-info">
                    <p class="user-name">{{ Auth::user()->name }}</p>
                    <p class="user-role">Operario</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <div class="topbar">
            <div>
                <p class="topbar-title">
                    @isset($pageTitle)
                        {{ $pageTitle }}
                    @else
                        Estación de Servicio "La Trocha"
                    @endisset
                </p>
                <p class="topbar-sub">
                    @isset($pageSubtitle)
                        {{ $pageSubtitle }}
                    @else
                        Biomax S.A. · Campohermoso, Boyacá
                    @endisset
                </p>
            </div>
            <div class="topbar-date">
                {{ now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            </div>
        </div>

        <main class="page-content">
            {{ $slot }}
        </main>
    </div>
    
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    @stack('scripts')

</body>
</html>