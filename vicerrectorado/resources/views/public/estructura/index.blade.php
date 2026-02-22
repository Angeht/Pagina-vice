<x-public-layout>

<div class="container mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Estructura Académica
    </h1>

    {{-- DIRECCIONES --}}
    <h2 class="text-2xl font-semibold mb-6">
        Direcciones
    </h2>

    <div class="grid md:grid-cols-3 gap-8 mb-16">
        @foreach($direcciones as $u)
            <a href="{{ route('estructura.show', $u) }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-xl transition">

                <h3 class="text-xl font-semibold mb-2">
                    {{ $u->nombre }}
                </h3>

                <p class="text-gray-600 text-sm">
                    {{ \Illuminate\Support\Str::limit($u->descripcion, 100) }}
                </p>
            </a>
        @endforeach
    </div>

    {{-- UNIDADES DE APOYO --}}
    <h2 class="text-2xl font-semibold mb-6">
        Unidades de Apoyo
    </h2>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach($unidades as $u)
            <a href="{{ route('estructura.show', $u) }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-xl transition">

                <h3 class="text-xl font-semibold mb-2">
                    {{ $u->nombre }}
                </h3>

                <p class="text-gray-600 text-sm">
                    {{ \Illuminate\Support\Str::limit($u->descripcion, 100) }}
                </p>
            </a>
        @endforeach
    </div>

</div>

</x-public-layout>