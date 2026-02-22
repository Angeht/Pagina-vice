<div class="container mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Gestión de Noticias
        </h1>
    </div>

    {{-- Mensaje éxito --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    {{-- Formulario --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">
            {{ $noticiaId ? 'Editar Noticia' : 'Nueva Noticia' }}
        </h2>

        <form wire:submit.prevent="guardar" class="space-y-4">

            {{-- Título --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Título *
                </label>
                <input type="text"
                       wire:model="titulo"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                       placeholder="Título de la noticia">

                @error('titulo')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Resumen --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Resumen
                </label>
                <textarea wire:model="resumen"
                          rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Breve resumen">
                </textarea>
            </div>

            {{-- Contenido --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Contenido *
                </label>
                <textarea wire:model="contenido"
                          rows="6"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Contenido completo">
                </textarea>

                @error('contenido')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Categoría --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Categoría
                </label>
                <select wire:model="categoria_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sin categoría</option>
                    @foreach(\App\Models\Categoria::all() as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Imagen destacada
                </label>

                <input type="file"
                    wire:model="imagen"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded-lg p-2">

                @error('imagen')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                {{-- Preview --}}
                @if ($imagen)
                    <div class="mt-4 relative inline-block">
                        <img src="{{ $imagen->temporaryUrl() }}"
                            class="w-40 rounded border">
                        <button type="button"
                                wire:click="limpiarImagen"
                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 hover:bg-red-600"
                                title="Quitar imagen">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            {{-- Publicado --}}
            <div class="flex items-center">
                <input type="checkbox"
                       wire:model="publicado"
                       class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                <span class="ml-2 text-sm text-gray-700">
                    Publicar inmediatamente
                </span>
            </div>

            {{-- Botones --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    {{ $noticiaId ? 'Actualizar' : 'Guardar' }}
                </button>

                @if($noticiaId || $titulo || $resumen || $contenido || $imagen)
                    <button type="button"
                            wire:click="cancelar"
                            class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                        Cancelar
                    </button>
                @endif
            </div>

        </form>
    </div>

    {{-- Tabla --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">

        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-xl font-semibold">
                Noticias Registradas
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Título
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Fecha
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($noticias as $noticia)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $noticia->titulo }}
                                </div>

                                @if($noticia->resumen)
                                    <div class="text-sm text-gray-500">
                                        {{ \Illuminate\Support\Str::limit($noticia->resumen, 80) }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if($noticia->publicado)
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Publicado
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Borrador
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $noticia->created_at->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <button wire:click="editar({{ $noticia->id }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                    Editar
                                </button>

                                <button wire:click="eliminar({{ $noticia->id }})"
                                        onclick="return confirm('¿Estás seguro de eliminar esta noticia?')"
                                        class="text-red-600 hover:text-red-900">
                                    Eliminar
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                No hay noticias registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINACIÓN --}}
        @if($noticias->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t">
                {{ $noticias->links() }}
            </div>
        @endif

    </div>

</div>
