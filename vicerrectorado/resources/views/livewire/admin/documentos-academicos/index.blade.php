<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">📄 Gestión Académica</h1>
            <p class="text-gray-500 mt-1">Administra documentos: calendarios, reglamentos, planes de estudio y directivas.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
           class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition text-sm font-medium">
            ← Dashboard
        </a>
    </div>

    {{-- Flash --}}
    @if(session()->has('message'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- ── FORMULARIO ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8" id="form-doc"
         x-data
         x-on:editar-documento.window="$el.scrollIntoView({behavior:'smooth', block:'start'})">
        <h2 class="text-lg font-bold text-gray-800 mb-5">
            {{ $documentoId ? '✏️ Editar Documento' : '➕ Nuevo Documento' }}
        </h2>

        <form wire:submit.prevent="guardar" class="space-y-4">

            {{-- Título --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Título <span class="text-red-500">*</span></label>
                <input type="text" wire:model="titulo"
                       placeholder="Ej: Reglamento General 2026"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('titulo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tipo + Fecha --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo <span class="text-red-500">*</span></label>
                    <select wire:model="tipo"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Seleccione tipo</option>
                        <option value="calendario">Calendario Académico</option>
                        <option value="reglamento">Reglamento</option>
                        <option value="plan_estudio">Plan de Estudio</option>
                        <option value="directiva">Directiva</option>
                    </select>
                    @error('tipo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de publicación</label>
                    <input type="date" wire:model="fecha_publicacion"
                           class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('fecha_publicacion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción (opcional)</label>
                <textarea wire:model="descripcion" rows="3"
                          placeholder="Breve descripción del documento..."
                          class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                @error('descripcion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Archivo PDF --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Archivo PDF {{ $documentoId ? '(dejar vacío para conservar el actual)' : '' }}
                </label>
                <label class="flex items-center gap-3 w-full cursor-pointer border border-dashed border-blue-300 rounded-xl px-4 py-3 bg-blue-50 hover:bg-blue-100 transition">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <span class="text-sm text-blue-600 font-medium">
                        @if($archivo && !is_string($archivo))
                            {{ $archivo->getClientOriginalName() }}
                        @else
                            Seleccionar PDF (máx. 10 MB)
                        @endif
                    </span>
                    <input type="file" wire:model="archivo" accept="application/pdf" class="hidden">
                </label>
                @error('archivo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Activo + Botones --}}
            <div class="flex items-center justify-between pt-2">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" wire:model="activo"
                           class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">Visible en el sitio</span>
                </label>

                <div class="flex gap-3">
                    @if($documentoId)
                        <button type="button" wire:click="cancelarEdicion"
                                class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">
                            Cancelar
                        </button>
                    @endif
                    <button type="submit" wire:loading.attr="disabled"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition shadow-sm disabled:opacity-60">
                        <span wire:loading.remove>{{ $documentoId ? '💾 Actualizar' : '✅ Guardar Documento' }}</span>
                        <span wire:loading>Guardando...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- ── LISTA DE DOCUMENTOS ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">📋 Documentos ({{ $documentos->total() }})</h2>
            <span class="text-xs text-gray-400">Ordenados por fecha de publicación</span>
        </div>

        @if($documentos->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-14 h-14 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-sm">No hay documentos. ¡Agrega el primero!</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Documento</th>
                            <th class="px-6 py-3 text-left">Tipo</th>
                            <th class="px-6 py-3 text-left">Fecha</th>
                            <th class="px-6 py-3 text-center">Archivo</th>
                            <th class="px-6 py-3 text-center">Estado</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($documentos as $doc)
                            <tr class="hover:bg-gray-50 transition {{ $documentoId === $doc->id ? 'bg-blue-50 ring-1 ring-inset ring-blue-200' : '' }}">
                                {{-- Título + descripción --}}
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900 leading-tight">{{ $doc->titulo }}</p>
                                    @if($doc->descripcion)
                                        <p class="text-gray-400 text-xs mt-0.5 line-clamp-1">{{ $doc->descripcion }}</p>
                                    @endif
                                </td>

                                {{-- Tipo badge --}}
                                <td class="px-6 py-4">
                                    @php
                                        $tipos = [
                                            'calendario'   => ['label' => 'Calendario',   'class' => 'bg-blue-100 text-blue-700'],
                                            'reglamento'   => ['label' => 'Reglamento',   'class' => 'bg-purple-100 text-purple-700'],
                                            'plan_estudio' => ['label' => 'Plan de Estudio','class'=> 'bg-green-100 text-green-700'],
                                            'directiva'    => ['label' => 'Directiva',    'class' => 'bg-orange-100 text-orange-700'],
                                        ];
                                        $t = $tipos[$doc->tipo] ?? ['label' => $doc->tipo, 'class' => 'bg-gray-100 text-gray-600'];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $t['class'] }}">
                                        {{ $t['label'] }}
                                    </span>
                                </td>

                                {{-- Fecha --}}
                                <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                    {{ $doc->fecha_publicacion ? \Carbon\Carbon::parse($doc->fecha_publicacion)->format('d/m/Y') : '—' }}
                                </td>

                                {{-- Archivo --}}
                                <td class="px-6 py-4 text-center">
                                    @if($doc->archivo)
                                        <a href="{{ asset('storage/' . $doc->archivo) }}" target="_blank"
                                           class="inline-flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-100 transition">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM12 17H8v-2h4v2zm4-4H8v-2h8v2z"/>
                                            </svg>
                                            PDF
                                        </a>
                                    @else
                                        <span class="text-gray-300 text-xs">Sin archivo</span>
                                    @endif
                                </td>

                                {{-- Estado --}}
                                <td class="px-6 py-4 text-center">
                                    <span class="{{ $doc->activo ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} px-2.5 py-1 rounded-full text-[11px] font-bold">
                                        {{ $doc->activo ? 'Visible' : 'Oculto' }}
                                    </span>
                                </td>

                                {{-- Acciones --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Editar --}}
                                        <button wire:click="editar({{ $doc->id }})"
                                                class="p-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition" title="Editar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>

                                        {{-- Eliminar con confirmación --}}
                                        @if($confirmandoEliminar === $doc->id)
                                            <div class="flex items-center gap-1">
                                                <button wire:click="eliminar"
                                                        class="px-3 py-1.5 bg-red-600 text-white rounded-lg text-xs font-bold hover:bg-red-700 transition">
                                                    ¿Eliminar?
                                                </button>
                                                <button wire:click="cancelarEliminar"
                                                        class="px-2 py-1.5 bg-gray-200 text-gray-600 rounded-lg text-xs hover:bg-gray-300 transition">
                                                    No
                                                </button>
                                            </div>
                                        @else
                                            <button wire:click="confirmarEliminar({{ $doc->id }})"
                                                    class="p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition" title="Eliminar">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            @if($documentos->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $documentos->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
