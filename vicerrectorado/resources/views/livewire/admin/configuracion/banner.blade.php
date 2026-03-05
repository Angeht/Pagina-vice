<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Configuración Banner Principal
    </h1>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="guardar">
        <div class="bg-white shadow rounded p-6 space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Título principal
                </label>
                <input type="text" wire:model="titulo"
                       class="w-full border border-gray-300 rounded p-2">
                @error('titulo')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Subtítulo
                </label>
                <textarea wire:model="subtitulo"
                          rows="3"
                          class="w-full border border-gray-300 rounded p-2">
                </textarea>
                @error('subtitulo')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Imagen banner
                </label>
                <input type="file" 
                       wire:model="imagen"
                       accept="image/*"
                       class="w-full border border-gray-300 rounded p-2">
                
                @error('imagen')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror

                <div wire:loading wire:target="imagen" class="text-sm text-blue-600 mt-2">
                    Cargando imagen...
                </div>

                {{-- Preview imagen temporal --}}
                @if ($imagen)
                    <div class="mt-4 relative inline-block">
                        <img src="{{ $imagen->temporaryUrl() }}"
                             class="w-64 rounded border">
                        <button type="button"
                                wire:click="limpiarImagen"
                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 hover:bg-red-600"
                                title="Quitar imagen">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @elseif($imagen_actual)
                    {{-- Imagen actual --}}
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
                        <img src="{{ asset('storage/' . $imagen_actual) }}"
                             class="w-64 rounded border">
                    </div>
                @endif
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Guardar cambios
                </button>
            </div>

        </div>
    </form>

</div>
