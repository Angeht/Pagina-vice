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

            <div>
                <input type="text" wire:model="titulo"
                       placeholder="Título"
                       class="w-full border rounded p-2 @error('titulo') border-red-500 @enderror">
                @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <select wire:model="tipo" class="w-full border rounded p-2 @error('tipo') border-red-500 @enderror">
                    <option value="">Seleccione tipo</option>
                    <option value="docente">Docente</option>
                    <option value="estudiante">Estudiante</option>
                    <option value="beca">Beca</option>
                    <option value="concurso">Concurso</option>
                </select>
                @error('tipo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <textarea wire:model="descripcion"
                          placeholder="Descripción"
                          rows="4"
                          class="w-full border rounded p-2 @error('descripcion') border-red-500 @enderror"></textarea>
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Fecha Inicio</label>
                    <input type="date" wire:model="fecha_inicio"
                           class="border rounded p-2 w-full @error('fecha_inicio') border-red-500 @enderror">
                    @error('fecha_inicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Fecha Cierre</label>
                    <input type="date" wire:model="fecha_cierre"
                           class="border rounded p-2 w-full @error('fecha_cierre') border-red-500 @enderror">
                    @error('fecha_cierre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Archivo PDF (máx. 4MB)</label>
                <input type="file" wire:model="archivo" accept="application/pdf" class="w-full">
                @error('archivo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model="activo" class="rounded">
                <span>Activo</span>
            </label>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    {{ $convocatoriaId ? 'Actualizar' : 'Guardar' }}
                </button>

                @if($convocatoriaId)
                    <button type="button" wire:click="$refresh" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                        Cancelar
                    </button>
                @endif
            </div>

        </form>
        <hr class="my-8">
        <h2 class="text-xl font-semibold mb-4">
            Convocatorias Registradas
        </h2>

        <table class="w-full text-sm bg-white shadow rounded">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="p-3 text-left font-semibold">Título</th>
                    <th class="p-3 text-center font-semibold">Tipo</th>
                    <th class="p-3 text-center font-semibold">Estado</th>
                    <th class="p-3 text-center font-semibold">Cierre</th>
                    <th class="p-3 text-right font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($convocatorias as $c)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $c->titulo }}</td>
                        <td class="p-3 text-center">
                            <span class="px-2 py-1 text-xs rounded bg-gray-100 capitalize">
                                {{ $c->tipo }}
                            </span>
                        </td>
                        <td class="p-3 text-center">
                            @if($c->estado === 'abierta')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800 font-medium">
                                    Abierta
                                </span>
                            @elseif($c->estado === 'proxima')
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800 font-medium">
                                    Próxima
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-800 font-medium">
                                    Cerrada
                                </span>
                            @endif
                        </td>
                        <td class="p-3 text-center">{{ $c->fecha_cierre->format('d/m/Y') }}</td>
                        <td class="p-3 text-right space-x-3">
                            <button wire:click="editar({{ $c->id }})"
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                Editar
                            </button>

                            <button wire:click="eliminar({{ $c->id }})"
                                    onclick="return confirm('¿Eliminar convocatoria?')"
                                    class="text-red-600 hover:text-red-800 font-medium">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No hay convocatorias registradas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $convocatorias->links() }}
        </div>
    </div>

</div>