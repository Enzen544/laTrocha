<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inventario de Bodega <span class="text-sm text-gray-500">Control de productos y stock</span>
        </h2>
    </x-slot>

    <div id="bodega-app" class="py-6 px-4 max-w-5xl mx-auto">

        {{-- Alertas de stock bajo --}}
        <div x-data="bodegaApp()" x-init="init()">

            <div x-show="alertas.length > 0" class="border border-yellow-400 rounded-xl p-4 mb-6">
                <p class="text-yellow-500 font-semibold mb-2">⚠️ Alertas de Stock</p>
                <template x-for="a in alertas" :key="a.id">
                    <div class="flex justify-between items-center py-1">
                        <span x-text="a.nombre"></span>
                        <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full" x-text="a.stock_actual + ' unidades'"></span>
                    </div>
                </template>
            </div>

            {{-- Buscador y botón nuevo --}}
            <div class="flex gap-3 mb-6">
                <div class="flex-1 flex items-center bg-gray-100 rounded-xl px-4">
                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input x-model="busqueda" type="text" placeholder="Buscar producto..." class="bg-transparent w-full py-3 outline-none text-sm">
                </div>
                <button @click="abrirModalNuevo()" class="bg-black text-white px-5 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                    + Nuevo Producto
                </button>
            </div>

            {{-- Lista de productos --}}
            <template x-for="p in productosFiltrados" :key="p.id">
                <div class="bg-white rounded-2xl shadow-sm p-5 mb-4">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">⬡</span>
                            <div>
                                <p class="font-bold text-gray-800" x-text="p.nombre"></p>
                                <p class="text-sm text-gray-400" x-text="p.categoria"></p>
                            </div>
                        </div>
                        <span x-show="p.stock_bajo" class="bg-yellow-400 text-white text-xs font-bold px-3 py-1 rounded-full">Bajo</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-gray-400">Stock Actual</p>
                            <p class="font-bold text-lg" x-text="p.stock_actual"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Stock Mínimo</p>
                            <p class="font-bold text-lg" x-text="p.stock_minimo"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Precio Compra</p>
                            <p class="font-bold" x-text="'$' + parseFloat(p.precio_compra).toFixed(2)"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Precio Venta</p>
                            <p class="font-bold" x-text="'$' + parseFloat(p.precio_venta).toFixed(2)"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <button @click="abrirMovimiento(p, 'entrada')" class="bg-green-500 text-white py-2 rounded-xl text-sm font-semibold flex items-center justify-center gap-2">
                            ↗ Entrada
                        </button>
                        <button @click="abrirMovimiento(p, 'salida')" class="bg-red-500 text-white py-2 rounded-xl text-sm font-semibold flex items-center justify-center gap-2">
                            ↘ Salida
                        </button>
                    </div>
                </div>
            </template>

            {{-- Modal Nuevo Producto --}}
            <div x-show="modalNuevo" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg">Nuevo Producto</h3>
                        <button @click="modalNuevo = false" class="text-gray-400 text-xl">✕</button>
                    </div>
                    <div class="space-y-3">
                        <input x-model="form.nombre" type="text" placeholder="Nombre del producto" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                        <input x-model="form.categoria" type="text" placeholder="Categoría" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                        <div class="grid grid-cols-2 gap-3">
                            <input x-model="form.precio_compra" type="number" placeholder="Precio Compra" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                            <input x-model="form.precio_venta" type="number" placeholder="Precio Venta" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <input x-model="form.stock_actual" type="number" placeholder="Stock Inicial" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                            <input x-model="form.stock_minimo" type="number" placeholder="Stock Mínimo" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                        </div>
                    </div>
                    <button @click="guardarProducto()" class="mt-4 w-full bg-black text-white py-2 rounded-xl text-sm font-semibold">
                        Guardar Producto
                    </button>
                </div>
            </div>

            {{-- Modal Movimiento --}}
            <div x-show="modalMovimiento" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg" x-text="tipoMovimiento === 'entrada' ? '↗ Entrada de Stock' : '↘ Salida de Stock'"></h3>
                        <button @click="modalMovimiento = false" class="text-gray-400 text-xl">✕</button>
                    </div>
                    <p class="text-sm text-gray-500 mb-3" x-text="productoActivo ? productoActivo.nombre : ''"></p>
                    <div class="space-y-3">
                        <input x-model="movForm.cantidad" type="number" placeholder="Cantidad" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                        <input x-model="movForm.descripcion" type="text" placeholder="Descripción (opcional)" class="w-full border rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <button @click="registrarMovimiento()"
                        :class="tipoMovimiento === 'entrada' ? 'bg-green-500' : 'bg-red-500'"
                        class="mt-4 w-full text-white py-2 rounded-xl text-sm font-semibold">
                        Confirmar
                    </button>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function bodegaApp() {
            return {
                productos: @json($productos),
                busqueda: '',
                modalNuevo: false,
                modalMovimiento: false,
                productoActivo: null,
                tipoMovimiento: null,
                form: { nombre: '', categoria: '', precio_compra: '', precio_venta: '', stock_actual: 0, stock_minimo: 5 },
                movForm: { cantidad: '', descripcion: '' },

                init() {},

                get alertas() {
                    return this.productos.filter(p => p.stock_bajo);
                },

                get productosFiltrados() {
                    if (!this.busqueda) return this.productos;
                    return this.productos.filter(p =>
                        p.nombre.toLowerCase().includes(this.busqueda.toLowerCase()) ||
                        (p.categoria && p.categoria.toLowerCase().includes(this.busqueda.toLowerCase()))
                    );
                },

                abrirModalNuevo() {
                    this.form = { nombre: '', categoria: '', precio_compra: '', precio_venta: '', stock_actual: 0, stock_minimo: 5 };
                    this.modalNuevo = true;
                },

                abrirMovimiento(producto, tipo) {
                    this.productoActivo = producto;
                    this.tipoMovimiento = tipo;
                    this.movForm = { cantidad: '', descripcion: '' };
                    this.modalMovimiento = true;
                },

                async guardarProducto() {
                    const res = await fetch('/bodega', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.form)
                    });
                    if (res.ok) {
                        const nuevo = await res.json();
                        nuevo.stock_bajo = nuevo.stock_actual <= nuevo.stock_minimo;
                        this.productos.push(nuevo);
                        this.modalNuevo = false;
                    } else {
                        alert('Error al guardar el producto');
                    }
                },

                async registrarMovimiento() {
                    const res = await fetch('/bodega/movimiento', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            producto_id: this.productoActivo.id,
                            tipo: this.tipoMovimiento,
                            cantidad: this.movForm.cantidad,
                            descripcion: this.movForm.descripcion
                        })
                    });
                    if (res.ok) {
                        const data = await res.json();
                        const idx = this.productos.findIndex(p => p.id === this.productoActivo.id);
                        if (idx !== -1) {
                            this.productos[idx].stock_actual = data.stock_actual;
                            this.productos[idx].stock_bajo = data.stock_actual <= this.productos[idx].stock_minimo;
                        }
                        this.modalMovimiento = false;
                    } else {
                        const err = await res.json();
                        alert(err.error || 'Error al registrar movimiento');
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout>