<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Trocha – Biomax | Iniciar Sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-dark:  #0F6E56;
            --green-mid:   #1D9E75;
            --green-light: #5DCAA5;
            --green-pale:  #E1F5EE;
            --cream:       #F7F6F1;
            --text-dark:   #1a1a1a;
            --text-muted:  #5a5a5a;
            --border:      rgba(15,110,86,0.18);
            --radius:      14px;
        }

        body {
            min-height: 100vh;
            display: flex;
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            overflow: hidden;
        }

        /* ── Panel izquierdo decorativo ── */
        .side-panel {
            width: 48%;
            background: var(--green-dark);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            padding: 3rem;
        }

        .side-panel::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: rgba(29,158,117,0.25);
            top: -120px; left: -120px;
        }
        .side-panel::after {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: rgba(93,202,165,0.15);
            bottom: -80px; right: -80px;
        }

        .side-inner {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
        }

        .side-logo {
            width: 110px;
            margin-bottom: 2.5rem;
            mix-blend-mode: multiply;
        }

        .side-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            line-height: 1.25;
            margin-bottom: 1rem;
            color: #fff;
        }

        .side-sub {
            font-size: 0.95rem;
            font-weight: 300;
            color: rgba(255,255,255,0.72);
            max-width: 300px;
            line-height: 1.7;
        }

        .side-divider {
            width: 50px;
            height: 2px;
            background: var(--green-light);
            margin: 1.8rem auto;
            border-radius: 2px;
        }

        .side-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 8px 18px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.85);
            margin-top: 2rem;
        }

        .dot {
            width: 8px; height: 8px;
            background: var(--green-light);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.85); }
        }

        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
        }

        .form-card {
            width: 100%;
            max-width: 420px;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-eyebrow {
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--green-mid);
            margin-bottom: 0.5rem;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: var(--text-dark);
        }

        .form-sub {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-top: 0.4rem;
        }

        .field { margin-bottom: 1.4rem; }

        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.45rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            stroke: var(--green-mid);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.93rem;
            color: var(--text-dark);
            background: #fff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrap input:focus {
            border-color: var(--green-mid);
            box-shadow: 0 0 0 3px rgba(29,158,117,0.12);
        }

        .input-wrap input.is-invalid {
            border-color: #E24B4A;
        }

    
        .row-extras {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.83rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        .checkbox-label input[type="checkbox"] {
            accent-color: var(--green-dark);
            width: 15px; height: 15px;
        }

        .forgot-link {
            font-size: 0.83rem;
            color: var(--green-mid);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover { text-decoration: underline; }

    
        .btn-login {
            width: 100%;
            padding: 13px;
            background: var(--green-dark);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            letter-spacing: 0.02em;
        }

        .btn-login:hover { background: var(--green-mid); }
        .btn-login:active { transform: scale(0.98); }

      
        .alert-error {
            background: #FCEBEB;
            border: 1px solid #F7C1C1;
            border-radius: var(--radius);
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #A32D2D;
            margin-bottom: 1.4rem;
        }

        .field-error {
            font-size: 0.78rem;
            color: #A32D2D;
            margin-top: 5px;
        }

        .form-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        @media (max-width: 768px) {
            .side-panel { display: none; }
            .form-panel { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

    
    <div class="side-panel">
        <div class="side-inner">
            <img src="{{asset('images/descarga.png') }}" alt="Biomax" class="side-logo">
            <div class="side-divider"></div>
            <h1 class="side-title">Estación La Trocha</h1>
            <p class="side-sub">
                Sistema de gestión operativa para el control de combustible,
                bodega y reportes financieros.
            </p>
            <div class="side-badge">
                <span class="dot"></span>
                Sistema activo · Campohermoso, Boyacá
            </div>
        </div>
    </div>

    <div class="form-panel">
        <div class="form-card">

            <div class="form-header">
                <p class="form-eyebrow">Bienvenido</p>
                <h2 class="form-title">Iniciar sesión</h2>
                <p class="form-sub">Ingresa tus credenciales para continuar</p>
            </div>

          
            @if ($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('status'))
                <div style="background:#EAF3DE;border:1px solid #C0DD97;border-radius:14px;padding:12px 16px;font-size:.85rem;color:#3B6D11;margin-bottom:1.4rem;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Correo electrónico</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@latrocha.com"
                            required
                            autofocus
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        >
                    </div>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Contraseña</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        >
                    </div>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

            
                <div class="row-extras">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Recordarme
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Ingresar al sistema</button>
            </form>

            <p class="form-footer">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" style="color:#1D9E75;font-weight:500;text-decoration:none;">
                    Regístrate aquí
                </a>
                Estación de Servicio La Trocha · Biomax S.A. · Campohermoso, Boyacá
            </p>

        </div>
    </div>

</body>
</html>