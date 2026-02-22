<x-public-layout>

<div class="container mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-8">
        Noticias
    </h1>

    <!-- Filtro de Categorías -->
    <div class="mb-6 flex gap-3 flex-wrap">
        <a href="{{ route('noticias.index') }}"
           class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">
            Todas
        </a>

        @foreach(\App\Models\Categoria::all() as $categoria)
            <a href="{{ route('noticias.index', ['categoria' => $categoria->slug]) }}"
               class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                {{ $categoria->nombre }}
            </a>
        @endforeach
    </div>

    <!-- Grid de Noticias -->
    <div class="grid md:grid-cols-2 gap-6">

        @foreach($noticias as $noticia)
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2">
                    {{ $noticia->titulo }}
                </h2>

                <p class="text-gray-600 mb-4">
                    {{ \Illuminate\Support\Str::limit($noticia->resumen ?? $noticia->contenido, 120) }}
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
        @endforeach

    </div>

    <div class="mt-8">
        {{ $noticias->links() }}
    </div>

</div>

</x-public-layout>
