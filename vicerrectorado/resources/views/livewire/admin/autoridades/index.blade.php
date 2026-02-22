<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Gestión de Autoridades
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

            <input type="text" wire:model="cargo"
                   placeholder="Cargo"
                   class="w-full border rounded p-2">

            <textarea wire:model="descripcion"
                      placeholder="Descripción"
                      class="w-full border rounded p-2">
            </textarea>

            <input type="number" wire:model="orden"
                   placeholder="Orden"
                   class="w-full border rounded p-2">

            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model="activo">
                <span>Activo</span>
            </label>

            <input type="file" wire:model="foto">

            @if($foto)
                <img src="{{ $foto->temporaryUrl() }}" class="w-32 mt-2 rounded">
            @endif

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                {{ $autoridadId ? 'Actualizar' : 'Guardar' }}
            </button>

        </form>

    </div>

    <div class="bg-white shadow rounded p-6">

        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Orden</th>
                    <th>Activo</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($autoridades as $a)
                    <tr class="border-b">
                        <td>{{ $a->nombre }}</td>
                        <td>{{ $a->cargo }}</td>
                        <td>{{ $a->orden }}</td>
                        <td>{{ $a->activo ? 'Sí' : 'No' }}</td>
                        <td class="text-right">
                            <button wire:click="editar({{ $a->id }})"
                                    class="text-blue-600 mr-2">
                                Editar
                            </button>
                            <button wire:click="eliminar({{ $a->id }})"
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
            {{ $autoridades->links() }}
        </div>

    </div>

</div>