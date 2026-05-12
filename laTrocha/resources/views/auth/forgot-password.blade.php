<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Trocha – Biomax | Recuperar Contraseña</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-dark:  #0F6E56;
            --green-mid:   #1D9E75;
            --green-light: #5DCAA5;
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
        }

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
            margin-bottom: 2rem;
            mix-blend-mode: multiply;
        }

        .side-divider {
            width: 50px; height: 2px;
            background: var(--green-light);
            margin: 1.5rem auto;
            border-radius: 2px;
        }

        .side-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            line-height: 1.25;
            margin-bottom: 1rem;
        }

        .side-sub {
            font-size: 0.95rem;
            font-weight: 300;
            color: rgba(255,255,255,0.72);
            max-width: 300px;
            line-height: 1.7;
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
            margin-top: 1.5rem;
        }

        .dot {
            width: 8px; height: 8px;
            background: var(--green-light);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(0.85); }
        }

        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
        }

        .form-card { width: 100%; max-width: 420px; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            color: var(--green-mid);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 2rem;
            transition: gap 0.15s;
        }

        .back-link:hover { gap: 10px; }

        .back-link svg {
            width: 14px; height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .icon-circle {
            width: 56px; height: 56px;
            background: #E1F5EE;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .icon-circle svg {
            width: 26px; height: 26px;
            stroke: var(--green-dark);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .form-eyebrow {
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--green-mid);
            margin-bottom: 0.4rem;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: var(--text-dark);
        }

        .form-desc {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-top: 0.6rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .field { margin-bottom: 1.4rem; }

        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.4rem;
        }

        .input-wrap { position: relative; }

        .input-wrap svg {
            position: absolute;
            left: 14px; top: 50%;
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

        .field-error {
            font-size: 0.78rem;
            color: #A32D2D;
            margin-top: 5px;
        }

        .btn-send {
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-send svg {
            width: 16px; height: 16px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .btn-send:hover  { background: var(--green-mid); }
        .btn-send:active { transform: scale(0.98); }

        .alert-success {
            background: #EAF3DE;
            border: 1px solid #C0DD97;
            border-radius: var(--radius);
            padding: 14px 16px;
            font-size: 0.85rem;
            color: #3B6D11;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.5;
        }

        .alert-success svg {
            width: 18px; height: 18px;
            stroke: #3B6D11;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .form-footer {
            text-align: center;
            margin-top: 1.8rem;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .form-footer a {
            color: var(--green-mid);
            font-weight: 500;
            text-decoration: none;
        }

        .form-footer a:hover { text-decoration: underline; }

        @media (max-width: 768px) {
            .side-panel { display: none; }
            .form-panel  { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="side-panel">
        <div class="side-inner">
            <img src="{{ asset('images/biomaxImage.png') }}" alt="Biomax" class="side-logo">
            <div class="side-divider"></div>
            <h1 class="side-title">Estación La Trocha</h1>
            <p class="side-sub">Recupera el acceso a tu cuenta de forma segura.</p>
            <div class="side-badge">
                <span class="dot"></span>
                Sistema activo · Campohermoso, Boyacá
            </div>
        </div>
    </div>

    <div class="form-panel">
        <div class="form-card">

            <a href="{{ route('login') }}" class="back-link">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                Volver al inicio de sesión
            </a>

            <div class="icon-circle">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            </div>

            <p class="form-eyebrow">Seguridad</p>
            <h2 class="form-title">¿Olvidaste tu contraseña?</h2>
            <p class="form-desc">
                Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
            </p>

            @if (session('status'))
                <div class="alert-success">
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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
                            placeholder="tu@correo.com"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-send">
                    <svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Enviar enlace de recuperación
                </button>
            </form>

            <p class="form-footer">
                ¿Recordaste tu contraseña?
                <a href="{{ route('login') }}">Inicia sesión</a>
            </p>

        </div>
    </div>

</body>
</html>