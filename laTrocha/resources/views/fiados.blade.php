<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Fiados
            <span class="text-sm font-normal text-gray-500 ml-2">Clientes y entidades</span>
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4" id="fiados-app">

        {{-- Buscador + Nuevo Cliente --}}
        <div class="flex gap-3 mb-6">
            <div class="flex-1 relative">
                <span class="absolute left-3 top-3 text-gray-400">🔍</span>
                <input
                    v-model="busqueda"
                    type="text"
                    placeholder="Buscar cliente..."
                    class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-400"
                />
            </div>
            <button
                @click="abrirModalCliente"
                class="flex items-center gap-2 bg-black text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-gray-800 transition">
                + Nuevo Cliente
            </button>
        </div>

        {{-- Lista de clientes --}}
        <div class="space-y-4">
            <div
                v-for="entidad in entidadesFiltradas"
                :key="entidad.id"
                class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                {{-- Cabecera cliente --}}
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="font-bold text-lg">@{{ entidad.nombre }}</p>
                        <p class="text-gray-400 text-sm capitalize">@{{ entidad.tipo }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-red-500 font-bold text-xl">$@{{ formatMonto(entidad.deuda_total) }}</p>
                            <p class="text-gray-400 text-xs">Deuda total</p>
                        </div>
                        <button @click="eliminarEntidad(entidad.id)" class="text-red-400 hover:text-red-600 text-xl">🗑</button>
                    </div>
                </div>

                {{-- Botones Fiado / Abono --}}
                <div class="flex gap-2 mb-3">
                    <button
                        @click="toggleFormulario(entidad.id, 'fiado')"
                        class="flex-1 py-3 rounded-xl font-semibold text-white transition"
                        :class="formularioActivo === entidad.id && tipoActivo === 'fiado' ? 'bg-red-700' : 'bg-red-500 hover:bg-red-600'">
                        + Fiado
                    </button>
                    <button
                        @click="toggleFormulario(entidad.id, 'abono')"
                        class="flex-1 py-3 rounded-xl font-semibold text-white transition"
                        :class="formularioActivo === entidad.id && tipoActivo === 'abono' ? 'bg-green-700' : 'bg-green-500 hover:bg-green-600'">
                        $ Abono
                    </button>
                </div>

                {{-- Formulario expandible --}}
                <div v-if="formularioActivo === entidad.id" class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <p class="font-semibold mb-3">Tipo de Registro</p>
                    <div class="flex gap-4 mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" v-model="form.tipo_registro" value="pesos" class="accent-blue-500" />
                            Pesos ($)
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" v-model="form.tipo_registro" value="galones" class="accent-blue-500" />
                            Galones
                        </label>
                    </div>

                    <label class="block text-sm font-medium mb-1">
                        @{{ form.tipo_registro === 'pesos' ? 'Monto ($)' : 'Galones' }}
                    </label>
                    <input
                        v-model="form.monto"
                        type="number"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-green-400"
                    />

                    <label class="block text-sm font-medium mb-1">Descripción (opcional)</label>
                    <input
                        v-model="form.descripcion"
                        type="text"
                        placeholder="Ej: Gasolina, productos, etc."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-green-400"
                    />

                    <div class="flex gap-2">
                        <button
                            @click="registrar(entidad.id, 'fiado')"
                            class="flex-1 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition">
                            Registrar Fiado
                        </button>
                        <button
                            @click="registrar(entidad.id, 'abono')"
                            class="flex-1 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition">
                            Registrar Abono
                        </button>
                    </div>
                </div>
            </div>

            <p v-if="entidadesFiltradas.length === 0" class="text-center text-gray-400 py-10">
                No hay clientes registrados.
            </p>
        </div>

        {{-- Modal Nuevo Cliente --}}
        <div v-if="modalCliente" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
                <div class="flex justify-between items-center mb-1">
                    <h3 class="text-xl font-bold">Agregar Cliente</h3>
                    <button @click="modalCliente = false" class="text-gray-400 hover:text-gray-600 text-2xl">✕</button>
                </div>
                <p class="text-gray-400 text-sm mb-4">Registre un nuevo cliente o entidad</p>

                <label class="block font-medium mb-1">Nombre</label>
                <input
                    v-model="nuevoCliente.nombre"
                    type="text"
                    placeholder="Nombre del cliente"
                    class="w-full border border-gray-200 bg-gray-50 rounded-lg px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-green-400"
                />

                <label class="block font-medium mb-2">Tipo</label>
                <div class="flex gap-4 mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" v-model="nuevoCliente.tipo" value="persona" class="accent-blue-500" />
                        Persona
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" v-model="nuevoCliente.tipo" value="entidad" class="accent-blue-500" />
                        Entidad
                    </label>
                </div>

                <button
                    @click="guardarCliente"
                    class="w-full py-3 bg-black text-white font-semibold rounded-xl hover:bg-gray-800 transition">
                    Guardar Cliente
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    entidades: @json($entidades),
                    busqueda: '',
                    modalCliente: false,
                    formularioActivo: null,
                    tipoActivo: null,
                    nuevoCliente: { nombre: '', tipo: 'persona' },
                    form: { tipo_registro: 'pesos', monto: '', descripcion: '' },
                }
            },
            computed: {
                entidadesFiltradas() {
                    if (!this.busqueda) return this.entidades;
                    return this.entidades.filter(e =>
                        e.nombre.toLowerCase().includes(this.busqueda.toLowerCase())
                    );
                }
            },
            methods: {
                formatMonto(val) {
                    return Number(val).toLocaleString('es-CO');
                },
                abrirModalCliente() {
                    this.nuevoCliente = { nombre: '', tipo: 'persona' };
                    this.modalCliente = true;
                },
                toggleFormulario(id, tipo) {
                    if (this.formularioActivo === id && this.tipoActivo === tipo) {
                        this.formularioActivo = null;
                        this.tipoActivo = null;
                    } else {
                        this.formularioActivo = id;
                        this.tipoActivo = tipo;
                        this.form = { tipo_registro: 'pesos', monto: '', descripcion: '' };
                    }
                },
                async guardarCliente() {
                    if (!this.nuevoCliente.nombre.trim()) return alert('El nombre es obligatorio');
                    const res = await fetch('/fiados/entidades', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.nuevoCliente)
                    });
                    if (res.ok) {
                        const nueva = await res.json();
                        this.entidades.push({ ...nueva, deuda_total: 0 });
                        this.modalCliente = false;
                    } else {
                        alert('Error al guardar cliente');
                    }
                },
                async registrar(entidadId, tipo) {
                    if (!this.form.monto || this.form.monto <= 0) return alert('Ingresa un monto válido');
                    const res = await fetch('/fiados', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            entidad_id: entidadId,
                            tipo: tipo,
                            tipo_registro: this.form.tipo_registro,
                            monto: this.form.monto,
                            descripcion: this.form.descripcion,
                        })
                    });
                    if (res.ok) {
                        const entidad = this.entidades.find(e => e.id === entidadId);
                        if (entidad) {
                            const monto = parseFloat(this.form.monto);
                            entidad.deuda_total = tipo === 'fiado'
                                ? parseFloat(entidad.deuda_total) + monto
                                : parseFloat(entidad.deuda_total) - monto;
                        }
                        this.formularioActivo = null;
                        this.tipoActivo = null;
                        this.form = { tipo_registro: 'pesos', monto: '', descripcion: '' };
                    } else {
                        alert('Error al registrar');
                    }
                },
                async eliminarEntidad(id) {
                    if (!confirm('¿Eliminar este cliente?')) return;
                    const res = await fetch(`/fiados/entidades/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                    });
                    if (res.ok) {
                        this.entidades = this.entidades.filter(e => e.id !== id);
                    }
                }
            }
        }).mount('#fiados-app');
    </script>
    @endpush
</x-app-layout>