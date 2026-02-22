<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Gestión Académica
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
                <option value="calendario">Calendario Académico</option>
                <option value="reglamento">Reglamento</option>
                <option value="plan_estudio">Plan de Estudio</option>
                <option value="directiva">Directiva</option>
            </select>

            <textarea wire:model="descripcion"
                      placeholder="Descripción"
                      class="w-full border rounded p-2"></textarea>

            <input type="file" wire:model="archivo" accept="application/pdf">

            <input type="date" wire:model="fecha_publicacion"
                   class="w-full border rounded p-2">

            <input type="number" wire:model="orden"
                   placeholder="Orden"
                   class="w-full border rounded p-2">

            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model="activo">
                <span>Activo</span>
            </label>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                {{ $documentoId ? 'Actualizar' : 'Guardar' }}
            </button>

        </form>

    </div>

</div>