<x-public-layout>

<div class="container mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-6">
        Resultados para: "{{ $q }}"
    </h1>

    {{-- NOTICIAS --}}
    @if($noticias->count())
        <h2 class="text-xl font-semibold mb-4">Noticias</h2>
        @foreach($noticias as $n)
            <a href="{{ route('noticias.show', $n) }}"
               class="block mb-2 text-blue-600">
                {{ $n->titulo }}
            </a>
        @endforeach
    @endif

    {{-- CONVOCATORIAS --}}
    @if($convocatorias->count())
        <h2 class="text-xl font-semibold mt-8 mb-4">Convocatorias</h2>
        @foreach($convocatorias as $c)
            <a href="{{ route('convocatorias.show', $c) }}"
               class="block mb-2 text-blue-600">
                {{ $c->titulo }}
            </a>
        @endforeach
    @endif

    {{-- DOCUMENTOS --}}
    @if($documentos->count())
        <h2 class="text-xl font-semibold mt-8 mb-4">Documentos</h2>
        @foreach($documentos as $d)
            <a href="{{ asset('storage/' . $d->archivo) }}"
               target="_blank"
               class="block mb-2 text-blue-600">
                {{ $d->titulo }}
            </a>
        @endforeach
    @endif

    @if(
        !$noticias->count() &&
        !$convocatorias->count() &&
        !$documentos->count()
    )
        <p class="mt-6 text-gray-500">
            No se encontraron resultados.
        </p>
    @endif

</div>

</x-public-layout>