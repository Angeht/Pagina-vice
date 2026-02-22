<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Configuración Banner Principal
    </h1>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 space-y-4">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Título principal
            </label>
            <input type="text" wire:model="titulo"
                   class="w-full border border-gray-300 rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Subtítulo
            </label>
            <textarea wire:model="subtitulo"
                      class="w-full border border-gray-300 rounded p-2">
            </textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Imagen banner
            </label>
            <input type="file" wire:model="imagen">
        </div>

        <button wire:click="guardar"
                class="px-4 py-2 bg-blue-600 text-white rounded">
            Guardar cambios
        </button>

    </div>

</div>
