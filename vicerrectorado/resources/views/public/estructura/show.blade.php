<x-public-layout>

<div class="container mx-auto px-6 py-12">

    <div class="max-w-3xl mx-auto">

        @if($unidad->imagen)
            <img src="{{ asset('storage/' . $unidad->imagen) }}"
                 class="w-full h-64 object-cover rounded mb-6">
        @endif

        <h1 class="text-4xl font-bold mb-4">
            {{ $unidad->nombre }}
        </h1>

        @if($unidad->responsable)
            <p class="text-blue-600 font-semibold mb-2">
                Responsable: {{ $unidad->responsable }}
            </p>
        @endif

        <div class="text-gray-700 mb-6">
            {{ $unidad->descripcion }}
        </div>

        <div class="text-sm text-gray-600 space-y-1">
            @if($unidad->correo)
                <p>Email: {{ $unidad->correo }}</p>
            @endif

            @if($unidad->telefono)
                <p>Teléfono: {{ $unidad->telefono }}</p>
            @endif
        </div>

    </div>

</div>

</x-public-layout>