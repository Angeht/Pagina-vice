<x-public-layout>

<div class="container mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Convocatorias
    </h1>

    {{-- ABIERTAS --}}
    @if($abiertas->count())
        <h2 class="text-2xl font-semibold text-green-600 mb-6">
            Convocatorias Abiertas
        </h2>

        <div class="space-y-4 mb-12">
            @foreach($abiertas as $c)
                <a href="{{ route('convocatorias.show', $c) }}"
                   class="block bg-white shadow rounded p-4 hover:shadow-lg transition">

                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-lg">
                                {{ $c->titulo }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Cierra: {{ $c->fecha_cierre->format('d/m/Y') }}
                            </p>
                        </div>

                        <span class="px-3 py-1 bg-green-100 text-green-700 text-sm rounded">
                            Abierta
                        </span>
                    </div>

                </a>
            @endforeach
        </div>
    @endif


    {{-- PROXIMAS --}}
    @if($proximas->count())
        <h2 class="text-2xl font-semibold text-yellow-600 mb-6">
            Próximas Convocatorias
        </h2>

        <div class="space-y-4 mb-12">
            @foreach($proximas as $c)
                <a href="{{ route('convocatorias.show', $c) }}"
                   class="block bg-white shadow rounded p-4 hover:shadow-lg transition">

                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-lg">
                                {{ $c->titulo }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Inicia: {{ $c->fecha_inicio->format('d/m/Y') }}
                            </p>
                        </div>

                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm rounded">
                            Próxima
                        </span>
                    </div>

                </a>
            @endforeach
        </div>
    @endif


    {{-- CERRADAS --}}
    @if($cerradas->count())
        <h2 class="text-2xl font-semibold text-red-600 mb-6">
            Convocatorias Cerradas
        </h2>

        <div class="space-y-4">
            @foreach($cerradas as $c)
                <div class="bg-gray-100 rounded p-4">

                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-lg">
                                {{ $c->titulo }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Cerró: {{ $c->fecha_cierre->format('d/m/Y') }}
                            </p>
                        </div>

                        <span class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded">
                            Cerrada
                        </span>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

</x-public-layout>