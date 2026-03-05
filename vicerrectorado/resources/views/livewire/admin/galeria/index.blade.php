<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">🖼️ Galería de Imágenes</h1>
            <p class="text-gray-500 mt-1">Administra las imágenes del carrusel en la página principal.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
           class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition text-sm font-medium">
            ← Dashboard
        </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('message'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- ── PANEL SUBIR IMÁGENES ───────────────────────────────────── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <h2 class="text-lg font-bold text-gray-800 mb-4">➕ Subir Nuevas Imágenes</h2>

        <div class="grid md:grid-cols-2 gap-4 mb-4">
            {{-- Título (opcional) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Título (opcional)</label>
                <input wire:model="nuevoTitulo" type="text" placeholder="Ej: Ceremonia de Graduación"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nuevoTitulo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Descripción (opcional) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción (opcional)</label>
                <input wire:model="nuevaDescripcion" type="text" placeholder="Breve descripción..."
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nuevaDescripcion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Selector de archivos múltiples --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Imágenes <span class="text-red-500">*</span></label>
            <label class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-blue-300 rounded-xl cursor-pointer bg-blue-50 hover:bg-blue-100 transition">
                <svg class="w-10 h-10 text-blue-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-blue-500 font-medium text-sm">
                    @if(count($nuevasImagenes) > 0)
                        {{ count($nuevasImagenes) }} imagen(es) seleccionada(s)
                    @else
                        Haz clic para seleccionar imágenes (puedes elegir varias)
                    @endif
                </span>
                <span class="text-gray-400 text-xs mt-1">JPG, PNG, WebP — máx. 4 MB cada una</span>
                <input wire:model="nuevasImagenes" type="file" multiple accept="image/*" class="hidden">
            </label>
            @error('nuevasImagenes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @error('nuevasImagenes.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Preview de imágenes seleccionadas --}}
        @if(count($nuevasImagenes) > 0)
            <div class="flex flex-wrap gap-3 mb-4">
                @foreach($nuevasImagenes as $img)
                    @if(!is_string($img))
                        <img src="{{ $img->temporaryUrl() }}"
                             class="w-20 h-20 object-cover rounded-lg border-2 border-blue-300 shadow-sm" alt="Preview">
                    @endif
                @endforeach
            </div>
        @endif

        {{-- Botón guardar --}}
        <div class="flex items-center gap-3">
            <button wire:click="guardar" wire:loading.attr="disabled"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold text-sm transition shadow-sm disabled:opacity-60">
                <span wire:loading.remove wire:target="guardar">⬆️ Subir Imágenes</span>
                <span wire:loading wire:target="guardar">Subiendo...</span>
            </button>
            <div wire:loading wire:target="nuevasImagenes" class="text-sm text-blue-500">Cargando previsualización...</div>
        </div>
    </div>

    {{-- ── LISTADO DE IMÁGENES ───────────────────────────────────────── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-gray-800">📋 Imágenes del Carrusel ({{ $imagenes->count() }})</h2>
            @if($imagenes->count() > 0)
                <span class="text-xs text-gray-400">Usa las flechas ↑↓ para reordenar</span>
            @endif
        </div>

        @if($imagenes->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm">No hay imágenes aún. ¡Sube la primera!</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($imagenes as $imagen)
                    <div class="flex gap-4 items-start p-4 rounded-xl border border-gray-100 hover:bg-gray-50 transition">

                        {{-- Miniatura --}}
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $imagen->imagen) }}"
                                 alt="{{ $imagen->titulo }}"
                                 class="w-28 h-20 object-cover rounded-lg shadow-sm border border-gray-200">
                        </div>

                        {{-- Info / Edición --}}
                        <div class="flex-1 min-w-0">
                            @if($editandoId === $imagen->id)
                                {{-- Modo edición --}}
                                <div class="space-y-2">
                                    <input wire:model="editTitulo" type="text" placeholder="Título..."
                                           class="w-full border border-blue-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @error('editTitulo') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                                    <input wire:model="editDescripcion" type="text" placeholder="Descripción..."
                                           class="w-full border border-blue-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @error('editDescripcion') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                                    <div class="flex gap-2 pt-1">
                                        <button wire:click="guardarEdicion"
                                                class="px-4 py-1.5 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-700 transition">
                                            Guardar
                                        </button>
                                        <button wire:click="cancelarEdicion"
                                                class="px-4 py-1.5 bg-gray-200 text-gray-700 rounded-lg text-xs font-semibold hover:bg-gray-300 transition">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            @else
                                {{-- Modo vista --}}
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">
                                            {{ $imagen->titulo ?: '(sin título)' }}
                                        </p>
                                        @if($imagen->descripcion)
                                            <p class="text-gray-500 text-xs mt-0.5 line-clamp-2">{{ $imagen->descripcion }}</p>
                                        @endif
                                        <p class="text-gray-400 text-[10px] mt-1">Orden: {{ $imagen->orden }}</p>
                                    </div>
                                    {{-- Badge activo --}}
                                    <span class="{{ $imagen->activo ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} px-2 py-0.5 rounded-full text-[10px] font-bold uppercase whitespace-nowrap">
                                        {{ $imagen->activo ? 'Visible' : 'Oculta' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Acciones --}}
                        <div class="flex-shrink-0 flex flex-col gap-1.5">
                            {{-- Reordenar --}}
                            <div class="flex gap-1">
                                <button wire:click="subirOrden({{ $imagen->id }})" title="Subir"
                                        class="p-1.5 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 transition text-xs font-bold">↑</button>
                                <button wire:click="bajarOrden({{ $imagen->id }})" title="Bajar"
                                        class="p-1.5 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 transition text-xs font-bold">↓</button>
                            </div>
                            {{-- Toggle activo --}}
                            <button wire:click="toggleActivo({{ $imagen->id }})" title="{{ $imagen->activo ? 'Ocultar' : 'Mostrar' }}"
                                    class="{{ $imagen->activo ? 'bg-green-100 hover:bg-green-200 text-green-700' : 'bg-gray-100 hover:bg-gray-200 text-gray-600' }} p-1.5 rounded-lg transition text-xs font-bold">
                                {{ $imagen->activo ? '👁' : '🚫' }}
                            </button>
                            {{-- Editar --}}
                            <button wire:click="editar({{ $imagen->id }})" title="Editar"
                                    class="p-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition text-xs font-bold">✏️</button>
                            {{-- Eliminar --}}
                            @if($eliminandoId === $imagen->id)
                                <div class="flex gap-1">
                                    <button wire:click="eliminar"
                                            class="p-1.5 bg-red-600 text-white rounded-lg text-xs font-bold hover:bg-red-700 transition">¿Sí?</button>
                                    <button wire:click="cancelarEliminar"
                                            class="p-1.5 bg-gray-200 text-gray-600 rounded-lg text-xs hover:bg-gray-300 transition">✕</button>
                                </div>
                            @else
                                <button wire:click="confirmarEliminar({{ $imagen->id }})" title="Eliminar"
                                        class="p-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition text-xs font-bold">🗑</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
