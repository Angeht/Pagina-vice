@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Gestión de Noticias</h1>

<div class="bg-white shadow rounded p-6 mb-6">
    <form wire:submit.prevent="guardar" class="space-y-4">
        <input type="text" wire:model="titulo"
               placeholder="Título"
               class="w-full border rounded p-2">

        <textarea wire:model="resumen"
                  placeholder="Resumen"
                  class="w-full border rounded p-2"></textarea>

        <textarea wire:model="contenido"
                  placeholder="Contenido"
                  class="w-full border rounded p-2"></textarea>

        <label class="flex items-center space-x-2">
            <input type="checkbox" wire:model="publicado">
            <span>Publicado</span>
        </label>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
</div>


<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Categoría
    </label>

    <select wire:model="categoria_id"
            class="w-full border border-gray-300 rounded-lg p-2">

        <option value="">Seleccione categoría</option>

        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">
                {{ $categoria->nombre }}
            </option>
        @endforeach

    </select>
</div>


<div class="bg-white shadow rounded p-6">
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Título</th>
                <th class="text-left p-2">Estado</th>
                <th class="p-2">Acciones</th>
            </tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
            Categoría
            </th>
        </thead>
        <tbody>
            @foreach($noticias as $noticia)
                <tr class="border-b">
                    <td class="p-2">{{ $noticia->titulo }}</td>
                    <td class="p-2">
                        {{ $noticia->publicado ? 'Publicado' : 'Borrador' }}
                    </td>
                    <td class="p-2 space-x-2">
                        <button wire:click="editar({{ $noticia->id }})"
                                class="text-blue-600">
                            Editar
                        </button>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $noticia->categoria->nombre ?? 'Sin categoría' }}
                    </td>
                        <button wire:click="eliminar({{ $noticia->id }})"
                                class="text-red-600">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
