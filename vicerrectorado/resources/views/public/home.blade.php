<x-public-layout>

<div class="container mx-auto px-6 py-12">

    {{-- Hero institucional --}}
    @php
    $titulo = \App\Models\Configuracion::getValor('banner_titulo');
    $subtitulo = \App\Models\Configuracion::getValor('banner_subtitulo');
    $imagen = \App\Models\Configuracion::getValor('banner_imagen');
    @endphp

    <div class="mb-12 text-center relative">

        @if($imagen)
            <img src="{{ asset('storage/' . $imagen) }}"
                class="w-full h-64 object-cover rounded mb-6">
        @endif

        <h1 class="text-4xl font-bold mb-4">
            {{ $titulo ?? 'Vicerrectorado Académico' }}
        </h1>

        <p class="text-gray-600">
            {{ $subtitulo ?? 'Información oficial y comunicados institucionales' }}
        </p>

    </div>


{{-- CONVOCATORIAS ABIERTAS --}}
@if($convocatoriasAbiertas->count())
    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-green-600 mb-4">
            Convocatorias Abiertas
        </h2>

        @foreach($convocatoriasAbiertas as $c)
            <a href="{{ route('convocatorias.show', $c) }}"
               class="block bg-green-50 p-4 rounded mb-2">
                {{ $c->titulo }}
            </a>
        @endforeach
    </div>
@endif

{{-- DOCUMENTO RECIENTE --}}
@if($documentoReciente)
    <div class="mb-12 bg-blue-50 p-6 rounded">
        <h2 class="text-xl font-semibold mb-2">
            Documento Reciente
        </h2>

        <p class="mb-3">
            {{ $documentoReciente->titulo }}
        </p>

        <a href="{{ asset('storage/' . $documentoReciente->archivo) }}"
           target="_blank"
           class="text-blue-600 font-semibold">
            Descargar
        </a>
    </div>
@endif


    {{-- Últimas noticias --}}
    <h2 class="text-2xl font-semibold mb-6">
        Últimas Noticias
    </h2>

    <div class="grid md:grid-cols-3 gap-6">
        @forelse($noticias as $noticia)
            <div class="bg-white shadow rounded-lg p-6">
                @if($noticia->categoria)
                    <span class="text-xs text-blue-600 font-semibold uppercase block mb-2">
                        {{ $noticia->categoria->nombre }}
                    </span>
                @endif
                
                <h3 class="text-lg font-semibold mb-2">
                    {{ $noticia->titulo }}
                </h3>

                <p class="text-gray-600 mb-4">
                    {{ \Illuminate\Support\Str::limit($noticia->resumen ?? $noticia->contenido, 100) }}
                </p>
                @if($noticia->imagen)
                    <img src="{{ asset('storage/' . $noticia->imagen) }}"
                        class="w-full h-40 object-cover rounded mb-4">
                @endif
                <a href="{{ route('noticias.show', $noticia) }}"
                   class="text-blue-600 font-semibold">
                    Leer más →
                </a>
            </div>
        @empty
            <p>No hay noticias publicadas aún.</p>
        @endforelse

    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('noticias.index') }}"
           class="px-6 py-2 bg-blue-600 text-white rounded-lg">
            Ver todas las noticias
        </a>
    </div>
</div>

</x-public-layout>