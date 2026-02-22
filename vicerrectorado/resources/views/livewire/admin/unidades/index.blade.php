<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Gestión de Estructura (Direcciones / Unidades)
    </h1>

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 mb-8 space-y-4">

        <form wire:submit.prevent="guardar" class="space-y-4">

            <input type="text" wire:model="nombre"
                   placeholder="Nombre"
                   class="w-full border rounded p-2">

            <select wire:model="tipo" class="w-full border rounded p-2">
                <option value="">Seleccione tipo</option>
                <option value="direccion">Dirección</option>
                <option value="unidad">Unidad de Apoyo</option>
            </select>

            <input type="text" wire:model="responsable"
                   placeholder="Responsable"
                   class="w-full border rounded p-2">

            <textarea wire:model="descripcion"
                      placeholder="Descripción"
                      class="w-full border rounded p-2"></textarea>

            <input type="email" wire:model="correo"
                   placeholder="Correo"
                   class="w-full border rounded p-2">

            <input type="text" wire:model="telefono"
                   placeholder="Teléfono"
                   class="w-full border rounded p-2">

            <input type="number" wire:model="orden"
                   placeholder="Orden"
                   class="w-full border rounded p-2">

            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model="activo">
                <span>Activo</span>
            </label>

            <input type="file" wire:model="imagen">

            @if($imagen)
                <img src="{{ $imagen->temporaryUrl() }}" class="w-32 mt-2 rounded">
            @endif

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                {{ $unidadId ? 'Actualizar' : 'Guardar' }}
            </button>

        </form>

    </div>

    <div class="bg-white shadow rounded p-6">

        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Orden</th>
                    <th>Activo</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unidades as $u)
                    <tr class="border-b">
                        <td>{{ $u->nombre }}</td>
                        <td>{{ ucfirst($u->tipo) }}</td>
                        <td>{{ $u->orden }}</td>
                        <td>{{ $u->activo ? 'Sí' : 'No' }}</td>
                        <td class="text-right">
                            <button wire:click="editar({{ $u->id }})"
                                    class="text-blue-600 mr-2">
                                Editar
                            </button>
                            <button wire:click="eliminar({{ $u->id }})"
                                    onclick="return confirm('¿Eliminar?')"
                                    class="text-red-600">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $unidades->links() }}
        </div>

    </div>

</div>