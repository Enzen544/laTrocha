<x-app-layout>
    <x-slot name="pageTitle">Editar Registro</x-slot>
    <x-slot name="pageSubtitle">Control de Combustible</x-slot>

    <style>
        .card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #E8EAED;
            padding: 1.5rem;
            margin-bottom: 1.2rem
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: .25rem
        }

        .card-sub {
            font-size: .78rem;
            color: #999;
            margin-bottom: 1.4rem
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem
        }

        .field label {
            display: block;
            font-size: .82rem;
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: .4rem
        }

        .field input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #E8EAED;
            border-radius: 10px;
            font-size: .93rem;
            color: #1a1a1a;
            background: #F9FAFB;
            outline: none;
            transition: border-color .2s, box-shadow .2s
        }

        .field input:focus {
            border-color: #1D9E75;
            box-shadow: 0 0 0 3px rgba(29, 158, 117, .12);
            background: #fff
        }

        .calc-box {
            background: #F4F6F8;
            border-radius: 12px;
            padding: 1.2rem;
            margin: 1.2rem 0
        }

        .calc-title {
            font-size: .9rem;
            font-weight: 600;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 1rem
        }

        .calc-title svg {
            width: 16px;
            height: 16px;
            stroke: #555;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round
        }

        .calc-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 0;
            border-bottom: 1px solid #E0E0E0;
            font-size: .85rem
        }

        .calc-row:last-child {
            border-bottom: none
        }

        .calc-label {
            color: #666
        }

        .calc-value {
            font-weight: 600;
            color: #1a1a1a
        }

        .neg {
            color: #E24B4A
        }

        .pos {
            color: #1D9E75
        }

        .bold-row .calc-label {
            font-weight: 700;
            color: #1a1a1a
        }

        .bold-row .calc-value {
            font-size: .95rem;
            font-weight: 700
        }

        .btn-row {
            display: flex;
            gap: 1rem;
            margin-top: .5rem
        }

        .btn-save {
            flex: 1;
            padding: 13px;
            background: #0F6E56;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s
        }

        .btn-save:hover {
            background: #1D9E75
        }

        .btn-cancel {
            flex: 1;
            padding: 13px;
            background: #F4F6F8;
            color: #555;
            border: none;
            border-radius: 12px;
            font-size: .95rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background .2s
        }

        .btn-cancel:hover {
            background: #E8EAED
        }

        .alert-error {
            background: #FCEBEB;
            border: 1px solid #F7C1C1;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: .85rem;
            color: #A32D2D;
            margin-bottom: 1.2rem
        }

        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
            margin-bottom: 1rem
        }

        .badge-gasolina {
            background: #EBF3FF;
            color: #2563EB
        }

        .badge-acpm {
            background: #EAF3DE;
            color: #3B6D11
        }
    </style>

    @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <div id="app">
        <div class="card">
            <p class="card-title">Editar Registro</p>
            <p class="card-sub">Modifica los datos del registro ·
                {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</p>

            <span class="badge {{ $registro->tipo === 'gasolina' ? 'badge-gasolina' : 'badge-acpm' }}">
                {{ $registro->tipo === 'gasolina' ? 'Gasolina Corriente' : 'ACPM' }}
            </span>

            <form method="POST" action="{{ route('combustible.update', $registro->id) }}">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="field">
                        <label>Fecha</label>
                        <input type="date" name="fecha" value="{{ $registro->fecha }}" required>
                    </div>
                    <div class="field"></div>
                    <div class="field">
                        <label>Lectura Inicial (galones)</label>
                        <input type="number" name="lectura_anterior" v-model.number="lecIni" step="0.0001"
                            min="0" placeholder="0.0000"
                            value="{{ old('lectura_anterior', $registro->lectura_anterior) }}" required>
                    </div>
                    <div class="field">
                        <label>Lectura Final (galones)</label>
                        <input type="number" name="lectura_actual" v-model.number="lecFin" step="0.0001"
                            min="0" placeholder="0.0000"
                            value="{{ old('lectura_actual', $registro->lectura_actual) }}" required>
                    </div>
                    <div class="field">
                        <label>Fiados (galones)</label>
                        <input type="number" name="fiados_galones" v-model.number="fiados" step="0.0001"
                            min="0" placeholder="0.0000"
                            value="{{ old('fiados_galones', $registro->fiados_galones) }}">
                    </div>
                    <div class="field">
                        <label>Precio por Galón ($)</label>
                        <input type="number" name="precio_unitario" v-model.number="precio" step="0.01"
                            min="0" placeholder="0.00"
                            value="{{ old('precio_unitario', $registro->precio_unitario) }}" required>
                    </div>
                    <div class="field">
                        <label>Efectivo Recaudado ($)</label>
                        <input type="number" name="efectivo_recaudado" v-model.number="efectivo" step="0.01"
                            min="0" placeholder="0.00"
                            value="{{ old('efectivo_recaudado', $registro->efectivo_recaudado) }}">
                    </div>
                </div>

                <div class="calc-box">
                    <div class="calc-title">
                        <svg viewBox="0 0 24 24">
                            <rect x="4" y="2" width="16" height="20" rx="2" />
                            <line x1="8" y1="6" x2="16" y2="6" />
                            <line x1="8" y1="10" x2="16" y2="10" />
                            <line x1="8" y1="14" x2="12" y2="14" />
                        </svg>
                        Cálculos Automáticos
                    </div>
                    <div class="calc-row">
                        <span class="calc-label">Total Galones (Inicial - Final):</span>
                        <span class="calc-value">@{{ diferencia.toFixed(4) }} gal</span>
                    </div>
                    <div class="calc-row">
                        <span class="calc-label">Menos Fiados:</span>
                        <span class="calc-value neg">-@{{ fiados.toFixed(4) }} gal</span>
                    </div>
                    <div class="calc-row bold-row">
                        <span class="calc-label">Galones Vendidos:</span>
                        <span class="calc-value">@{{ galonesVendidos.toFixed(4) }} gal</span>
                    </div>
                    <div class="calc-row bold-row">
                        <span class="calc-label">Total Vendido:</span>
                        <span class="calc-value">$@{{ formatPesos(totalVendido) }}</span>
                    </div>
                    <div class="calc-row">
                        <span class="calc-label">Diferencia:</span>
                        <span :class="['calc-value', diferenciaPesos >= 0 ? 'pos' : 'neg']">
                            $@{{ formatPesos(Math.abs(diferenciaPesos)) }} @{{ diferenciaPesos >= 0 ? '↑' : '↓' }}
                        </span>
                    </div>
                </div>

                <div class="btn-row">
                    <a href="{{ route('combustible.index', ['tipo' => $registro->tipo]) }}"
                        class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-save">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.4.21/vue.global.prod.min.js"></script>
    <script>
        const {
            createApp
        } = Vue;
        createApp({
            data() {
                return {
                    lecIni: {{ $registro->lectura_anterior }},
                    lecFin: {{ $registro->lectura_actual }},
                    fiados: {{ $registro->fiados_galones }},
                    precio: {{ $registro->precio_unitario }},
                    efectivo: {{ $registro->efectivo_recaudado }},
                }
            },
            computed: {
                diferencia() {
                    return Math.max(0, this.lecIni - this.lecFin)
                },
                galonesVendidos() {
                    return Math.max(0, this.diferencia - this.fiados)
                },
                totalVendido() {
                    return this.galonesVendidos * this.precio
                },
                diferenciaPesos() {
                    return this.efectivo - this.totalVendido
                },
            },
            methods: {
                formatPesos(v) {
                    return new Intl.NumberFormat('es-CO', {
                        maximumFractionDigits: 0
                    }).format(v);
                }
            }
        }).mount('#app');
    </script>

</x-app-layout>
