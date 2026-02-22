<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Gestión de Convocatorias
    </h1>

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 mb-8 space-y-4">

        <form wire:submit.prevent="guardar" class="space-y-4">

            <input type="text" wire:model="titulo"
                   placeholder="Título"
                   class="w-full border rounded p-2">

            <select wire:model="tipo" class="w-full border rounded p-2">
                <option value="">Seleccione tipo</option>
                <option value="docente">Docente</option>
                <option value="estudiante">Estudiante</option>
                <option value="beca">Beca</option>
                <option value="concurso">Concurso</option>
            </select>

            <textarea wire:model="descripcion"
                      placeholder="Descripción"
                      class="w-full border rounded p-2"></textarea>

            <div class="grid grid-cols-2 gap-4">
                <input type="date" wire:model="fecha_inicio"
                       class="border rounded p-2">

                <input type="date" wire:model="fecha_cierre"
                       class="border rounded p-2">
            </div>

            <input type="file" wire:model="archivo" accept="application/pdf">

            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model="activo">
                <span>Activo</span>
            </label>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                {{ $convocatoriaId ? 'Actualizar' : 'Guardar' }}
            </button>

        </form>
        <hr class="my-8">
        <h2 class="text-xl font-semibold mb-4">
            Convocatorias Registradas
        </h2>

        <table class="w-full text-sm bg-white shadow rounded">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Título</th>
                    <th class="p-2">Tipo</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Cierre</th>
                    <th class="p-2 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($convocatorias as $c)
                    <tr class="border-b">
                        <td class="p-2">{{ $c->titulo }}</td>
                        <td class="p-2 capitalize">{{ $c->tipo }}</td>
                        <td class="p-2 capitalize">{{ $c->estado }}</td>
                        <td class="p-2">{{ $c->fecha_cierre->format('d/m/Y') }}</td>
                        <td class="p-2 text-right">
                            <button wire:click="editar({{ $c->id }})"
                                    class="text-blue-600 mr-3">
                                Editar
                            </button>

                            <button wire:click="eliminar({{ $c->id }})"
                                    onclick="return confirm('¿Eliminar convocatoria?')"
                                    class="text-red-600">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $convocatorias->links() }}
        </div>
    </div>

</div>