<x-app-layout>
    <x-slot name="pageTitle">Control de Combustible</x-slot>
    <x-slot name="pageSubtitle">Registro y cálculo automático</x-slot>

    <style>
        .tabs {
            display: flex;
            background: #fff;
            border-radius: 50px;
            padding: 4px;
            border: 1px solid #E8EAED;
            margin-bottom: 1.5rem
        }

        .tab {
            flex: 1;
            padding: 10px;
            text-align: center;
            border-radius: 50px;
            font-size: .88rem;
            font-weight: 500;
            cursor: pointer;
            color: #888;
            text-decoration: none;
            transition: all .15s
        }

        .tab.active {
            background: #1a1a1a;
            color: #fff
        }

        .tab:hover:not(.active) {
            background: #f4f6f8;
            color: #333
        }

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
            display: flex;
            align-items: center;
            gap: 8px;
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

        .btn-save {
            width: 100%;
            padding: 14px;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
            margin-top: .5rem
        }

        .btn-save:hover {
            background: #333
        }

        .alert-success {
            background: #EAF3DE;
            border: 1px solid #C0DD97;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: .85rem;
            color: #3B6D11;
            margin-bottom: 1.2rem
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

        .registros-table {
            width: 100%;
            border-collapse: collapse
        }

        .registros-table th {
            font-size: .75rem;
            font-weight: 600;
            color: #999;
            text-align: left;
            padding: 8px 10px;
            border-bottom: 1px solid #E8EAED
        }

        .registros-table td {
            font-size: .83rem;
            color: #1a1a1a;
            padding: 10px;
            border-bottom: 1px solid #F4F6F8
        }

        .registros-table tr:last-child td {
            border-bottom: none
        }

        .empty-state {
            text-align: center;
            padding: 2.5rem;
            color: #aaa;
            font-size: .85rem
        }

        .btn-edit {
            font-size: .75rem;
            color: #0F6E56;
            text-decoration: none;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #0F6E56;
            transition: all .15s
        }

        .btn-edit:hover {
            background: #0F6E56;
            color: #fff
        }

        .btn-del {
            font-size: .75rem;
            color: #A32D2D;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #A32D2D;
            background: none;
            cursor: pointer;
            transition: all .15s
        }

        .btn-del:hover {
            background: #A32D2D;
            color: #fff
        }
    </style>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <div class="tabs">
        <a href="{{ route('combustible.index', ['tipo' => 'gasolina']) }}"
            class="tab {{ $tipo === 'gasolina' ? 'active' : '' }}">Corriente</a>
        <a href="{{ route('combustible.index', ['tipo' => 'acpm']) }}"
            class="tab {{ $tipo === 'acpm' ? 'active' : '' }}">ACPM</a>
    </div>

    <div id="app">
        <div class="card">
            <p class="card-title">+ Nuevo Registro</p>
            <p class="card-sub">Ingrese las lecturas del día para
                {{ $tipo === 'gasolina' ? 'gasolina corriente' : 'ACPM' }}</p>

            <form method="POST" action="{{ route('combustible.store') }}">
                @csrf
                <input type="hidden" name="tipo" value="{{ $tipo }}">
                <input type="hidden" name="fecha" value="{{ now()->toDateString() }}">

                <div class="form-grid">
                    <div class="field">
                        <label>Lectura Inicial (galones)</label>
                        <input type="number" name="lectura_anterior" v-model.number="lecIni" step="0.0001"
                            min="0" placeholder="0.00" required>
                    </div>
                    <div class="field">
                        <label>Lectura Final (galones)</label>
                        <input type="number" name="lectura_actual" v-model.number="lecFin" step="0.0001"
                            min="0" placeholder="0.00" required>
                    </div>
                    <div class="field">
                        <label>Fiados (galones)</label>
                        <input type="number" name="fiados_galones" v-model.number="fiados" step="0.0001"
                            min="0" placeholder="0.00">
                    </div>
                    <div class="field">
                        <label>Precio por Galón ($)</label>
                        <input type="number" name="precio_unitario" v-model.number="precio" step="0.01"
                            min="0" placeholder="0.00" required>
                    </div>
                    <div class="field">
                        <label>Efectivo Recaudado ($)</label>
                        <input type="number" name="efectivo_recaudado" v-model.number="efectivo" step="0.01"
                            min="0" placeholder="0.00">
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
                        <span class="calc-label">Total Galones (Final - Inicial):</span>
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

                <button type="submit" class="btn-save">Guardar Registro</button>
            </form>
        </div>

        <div class="card">
            <p class="card-title">Últimos Registros</p>
            <p class="card-sub">Historial reciente de {{ $tipo === 'gasolina' ? 'corriente' : 'acpm' }}</p>

            @if ($registros->isEmpty())
                <div class="empty-state">No hay registros aún</div>
            @else
                <table class="registros-table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Lec. Inicial</th>
                            <th>Lec. Final</th>
                            <th>Galones Vendidos</th>
                            <th>Total</th>
                            <th>Diferencia</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registros as $reg)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($reg->fecha)->format('d/m/Y') }}</td>
                                <td>{{ number_format($reg->lectura_anterior, 4) }}</td>
                                <td>{{ number_format($reg->lectura_actual, 4) }}</td>
                                <td>{{ number_format($reg->galones_vendidos, 4) }} gal</td>
                                <td>${{ number_format($reg->total, 0, ',', '.') }}</td>
                                <td class="{{ $reg->diferencia_pesos >= 0 ? 'pos' : 'neg' }}">
                                    ${{ number_format(abs($reg->diferencia_pesos), 0, ',', '.') }}
                                    {{ $reg->diferencia_pesos >= 0 ? '↑' : '↓' }}
                                </td>
                                <td style="display:flex;gap:6px">
                                    <a href="{{ route('combustible.edit', $reg->id) }}" class="btn-edit">Editar</a>
                                    <form method="POST" action="{{ route('combustible.destroy', $reg->id) }}"
                                        onsubmit="return confirm('¿Eliminar este registro?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-del">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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
                    lecIni: 0,
                    lecFin: 0,
                    fiados: 0,
                    precio: 0,
                    efectivo: 0
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
