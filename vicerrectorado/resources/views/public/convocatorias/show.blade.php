<x-public-layout>

<div class="container mx-auto px-6 py-12 max-w-3xl">

    <h1 class="text-3xl font-bold mb-4">
        {{ $convocatoria->titulo }}
    </h1>

    <p class="mb-2 text-gray-600">
        Inicio: {{ $convocatoria->fecha_inicio->format('d/m/Y') }}
    </p>

    <p class="mb-6 text-gray-600">
        Cierre: {{ $convocatoria->fecha_cierre->format('d/m/Y') }}
    </p>

    <div class="mb-6 text-gray-700">
        {{ $convocatoria->descripcion }}
    </div>

    @if($convocatoria->archivo)
        <a href="{{ asset('storage/' . $convocatoria->archivo) }}"
           target="_blank"
           class="px-4 py-2 bg-blue-600 text-white rounded">
            Descargar Bases (PDF)
        </a>
    @endif

</div>

</x-public-layout>