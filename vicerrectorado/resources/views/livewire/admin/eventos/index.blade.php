<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Eventos y Momentos Destacados</h1>
        <button wire:click="nuevoEvento"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
            + Nuevo Evento
        </button>
    </div>

    @if(session('message'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif@if($mostrarFormulario)
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">
            {{ $eventoId ? 'Editar Evento' : 'Nuevo Evento' }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4"><div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
                <input wire:model="titulo" type="text"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Nombre del evento">
                @error('titulo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div><div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lugar</label>
                <input wire:model="lugar" type="text"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Lugar del evento">
            </div><div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de Portada</label>
                <input wire:model="imagen_portada" type="file" accept="image/*"
                    class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2">
                @error('imagen_portada') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @if($imagen_portada && !is_string($imagen_portada))
                    <img src="{{ $imagen_portada->temporaryUrl() }}" class="mt-2 h-20 rounded object-cover">
                @endif
            </div><div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha y Hora de Inicio</label>
                <input wire:model="fecha_inicio" type="datetime-local"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('fecha_inicio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div><div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha y Hora de Fin</label>
                <input wire:model="fecha_fin" type="datetime-local"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('fecha_fin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div><div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción Corta</label>
                <textarea wire:model="descripcion" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Breve descripción del evento..."></textarea>
            </div><div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Contenido Detallado</label>
                <textarea wire:model="contenido" rows="6"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Descripción completa del evento, programa, ponentes, etc."></textarea>
            </div><div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="activo" type="checkbox" class="rounded text-blue-600">
                    <span class="text-sm font-medium text-gray-700">Activo (visible en web)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="destacado" type="checkbox" class="rounded text-yellow-500">
                    <span class="text-sm font-medium text-gray-700">Destacado</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-5">
            <button wire:click="guardar"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                {{ $eventoId ? 'Actualizar' : 'Guardar' }}
            </button>
            <button wire:click="limpiarFormulario"
                class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                Cancelar
            </button>
        </div>
    </div>
    @endif@if($galeriaEventoId)
    <div class="bg-white rounded-xl shadow-md p-6 mb-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">
                📸 Galería: <span class="text-purple-700">{{ $eventoGaleria?->titulo }}</span>
            </h2>
            <button wire:click="cerrarGaleria"
                class="text-sm text-gray-500 hover:text-red-600">✕ Cerrar</button>
        </div>

        @if(session('galeriaMessage'))
            <div class="mb-3 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                {{ session('galeriaMessage') }}
            </div>
        @endif<div class="flex flex-wrap items-end gap-4 mb-5 p-4 bg-purple-50 rounded-lg">
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-medium text-gray-600 mb-1">Seleccionar imagen</label>
                <input wire:model="nuevaImagenGaleria" type="file" accept="image/*"
                    class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2 bg-white">
                @error('nuevaImagenGaleria') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-medium text-gray-600 mb-1">Descripción (opcional)</label>
                <input wire:model="nuevaDescGaleria" type="text"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white"
                    placeholder="Descripción de la foto...">
            </div>
            <button wire:click="subirImagenGaleria"
                class="px-5 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm font-medium">
                Subir Foto
            </button>
        </div>@if($nuevaImagenGaleria && !is_string($nuevaImagenGaleria))
            <img src="{{ $nuevaImagenGaleria->temporaryUrl() }}" class="h-24 rounded object-cover mb-4 border">
        @endif@if($galeriaActual->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
            @foreach($galeriaActual as $img)
            <div class="relative group rounded-lg overflow-hidden border">
                <img src="{{ asset('storage/' . $img->imagen) }}"
                    class="w-full h-32 object-cover" alt="{{ $img->descripcion }}">
                @if($img->descripcion)
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 text-center truncate">
                        {{ $img->descripcion }}
                    </div>
                @endif
                <button wire:click="eliminarImagenGaleria({{ $img->id }})"
                    wire:confirm="¿Eliminar esta imagen?"
                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    ✕
                </button>
            </div>
            @endforeach
        </div>
        @else
            <p class="text-center text-gray-400 py-6 text-sm">No hay imágenes en la galería aún. Sube la primera foto.</p>
        @endif
    </div>
    @endif<div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-4 border-b flex items-center gap-3">
            <input wire:model.live.debounce.300ms="busqueda" type="text"
                placeholder="Buscar por título o lugar..."
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Evento</th>
                    <th class="px-4 py-3 text-left">Fechas</th>
                    <th class="px-4 py-3 text-left">Lugar</th>
                    <th class="px-4 py-3 text-center">Estado</th>
                    <th class="px-4 py-3 text-center">Destacado</th>
                    <th class="px-4 py-3 text-center">Galería</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($eventos as $evento)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            @if($evento->imagen_portada)
                                <img src="{{ asset('storage/' . $evento->imagen_portada) }}"
                                    class="w-12 h-10 rounded object-cover border">
                            @else
                                <div class="w-12 h-10 rounded border border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-xs">
                                    📷
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-800">{{ $evento->titulo }}</div>
                                @if($evento->descripcion)
                                    <div class="text-xs text-gray-400 truncate max-w-xs">{{ $evento->descripcion }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        @if($evento->fecha_inicio)
                            <div>Inicio: {{ $evento->fecha_inicio->format('d/m/Y H:i') }}</div>
                        @endif
                        @if($evento->fecha_fin)
                            <div class="text-xs text-gray-400">Fin: {{ $evento->fecha_fin->format('d/m/Y H:i') }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ $evento->lugar ?? '—' }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        @php $estado = $evento->estado; @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $estado === 'en_curso'   ? 'bg-green-100 text-green-800' : '' }}
                            {{ $estado === 'proximo'    ? 'bg-blue-100 text-blue-800'  : '' }}
                            {{ $estado === 'finalizado' ? 'bg-gray-100 text-gray-600'  : '' }}">
                            {{ $estado === 'proximo' ? 'Próximo' : ($estado === 'en_curso' ? 'En Curso' : 'Finalizado') }}
                        </span>
                        @if(!$evento->activo)
                            <span class="ml-1 px-2 py-1 rounded-full text-xs bg-red-100 text-red-600">Oculto</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($evento->destacado)
                            <span class="text-yellow-500 text-lg" title="Destacado">⭐</span>
                        @else
                            <span class="text-gray-300 text-lg">☆</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <button wire:click="abrirGaleria({{ $evento->id }})"
                            class="px-3 py-1 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 text-xs font-medium">
                            📸 Galería
                            @if($evento->galeria_count ?? $evento->galeria->count())
                                <span class="ml-1 bg-purple-600 text-white rounded-full px-1.5">{{ $evento->galeria->count() }}</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-1">
                            <button wire:click="editar({{ $evento->id }})"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-xs">
                                Editar
                            </button>
                            <button wire:click="eliminar({{ $evento->id }})"
                                wire:confirm="¿Eliminar este evento y toda su galería?"
                                class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs">
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-400 py-10">
                        No hay eventos registrados aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t">
            {{ $eventos->links() }}
        </div>
    </div>
</div>
