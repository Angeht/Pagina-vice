<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Sección: Conociendo al Vicerrector Académico</h1>
    <p class="text-gray-500 text-sm mb-6">Esta información se muestra en la página principal del sitio.</p>

    @if(session('message'))
        <div class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md p-6 space-y-5">

        {{-- Nombre --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
            <input wire:model="nombre" type="text"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Dr. Juan Carlos Pérez López">
            @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Texto de presentación --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Texto de presentación</label>
            <p class="text-xs text-gray-400 mb-2">Aparecerá como párrafo descriptivo junto a la foto.</p>
            <textarea wire:model="texto_presentacion" rows="7"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Escriba aquí la presentación del Vicerrector Académico..."></textarea>
            <div class="text-right text-xs text-gray-400 mt-1">
                {{ strlen($texto_presentacion ?? '') }} / 3000 caracteres
            </div>
            @error('texto_presentacion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Cita destacada --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Cita o frase destacada (opcional)</label>
            <p class="text-xs text-gray-400 mb-2">Se mostrará en un bloque especial con viñeta de cita.</p>
            <textarea wire:model="cita" rows="3"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder='"La excelencia académica es el pilar fundamental de nuestra labor."'></textarea>
            @error('cita') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Imagen --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fotografía oficial</label>
            <p class="text-xs text-gray-400 mb-2">Recomendado: foto vertical (portrait), mínimo 400×500px. Máx. 3 MB.</p>
            <input wire:model="imagen" type="file" accept="image/*"
                class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2">

            <div wire:loading wire:target="imagen" class="text-blue-600 text-sm mt-2">
                Cargando imagen...
            </div>

            @error('imagen') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            {{-- Preview temporal --}}
            @if($imagen)
                <div class="mt-3 relative inline-block">
                    <img src="{{ $imagen->temporaryUrl() }}" class="h-52 rounded-xl border shadow object-cover">
                    <button type="button" wire:click="limpiarImagen"
                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center hover:bg-red-600 shadow">
                        ✕
                    </button>
                </div>
            @elseif($imagen_actual)
                <div class="mt-3">
                    <p class="text-xs text-gray-500 mb-2">Imagen actual:</p>
                    <img src="{{ asset('storage/' . $imagen_actual) }}" class="h-52 rounded-xl border shadow object-cover">
                </div>
            @endif
        </div>

        {{-- Botón guardar --}}
        <div class="pt-2 border-t">
            <button wire:click="guardar"
                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow">
                Guardar cambios
            </button>
        </div>
    </div>

    {{-- Preview --}}
    @if($nombre || $imagen_actual)
    <div class="mt-8">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Vista previa</h2>
        <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-xl p-6 flex gap-6 items-start shadow-sm">
            @if($imagen_actual)
                <img src="{{ asset('storage/' . $imagen_actual) }}" class="w-28 h-36 object-cover rounded-xl shadow border flex-shrink-0">
            @endif
            <div>
                <p class="text-xs text-blue-500 font-semibold uppercase tracking-widest mb-1">Conociendo al Vicerrector Académico</p>
                <h3 class="text-xl font-bold text-gray-800">{{ $nombre ?? '—' }}</h3>
                @if($texto_presentacion)
                    <p class="text-gray-600 text-sm line-clamp-3">{{ $texto_presentacion }}</p>
                @endif
                @if($cita)
                    <blockquote class="mt-2 border-l-4 border-blue-400 pl-3 text-sm italic text-gray-500">
                        "{{ $cita }}"
                    </blockquote>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
