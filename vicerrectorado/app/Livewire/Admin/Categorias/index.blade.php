<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Gestión de Categorías
    </h1>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 mb-6">

        <form wire:submit.prevent="guardar" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de la categoría
                </label>

                <input type="text"
                       wire:model="nombre"
                       class="w-full border border-gray-300 rounded-lg p-2">

                @error('nombre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded">
                {{ $categoriaId ? 'Actualizar' : 'Guardar' }}
            </button>

        </form>
    </div>

    <div class="bg-white shadow rounded p-6">

        <table class="w-full">

            <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Nombre</th>
                    <th class="text-right p-2">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categorias as $categoria)
                    <tr class="border-b">
                        <td class="p-2">
                            {{ $categoria->nombre }}
                        </td>

                        <td class="p-2 text-right">
                            <button wire:click="editar({{ $categoria->id }})"
                                    class="text-blue-600 mr-3">
                                Editar
                            </button>

                            <button wire:click="eliminar({{ $categoria->id }})"
                                    onclick="return confirm('¿Eliminar categoría?')"
                                    class="text-red-600">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <div class="mt-4">
            {{ $categorias->links() }}
        </div>

    </div>

</div>