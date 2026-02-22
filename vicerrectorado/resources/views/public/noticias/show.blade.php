<x-public-layout>

<div class="container mx-auto px-6 py-12 max-w-3xl">

    <h1 class="text-4xl font-bold mb-4">
        {{ $noticia->titulo }}
    </h1>

    <p class="text-gray-500 mb-6">
        {{ $noticia->created_at->format('d/m/Y') }}
    </p>

    <div class="prose max-w-none">
        {!! nl2br(e($noticia->contenido)) !!}
    </div>
    @if($noticia->imagen)
    <img src="{{ asset('storage/' . $noticia->imagen) }}"
         class="w-full h-40 object-cover rounded mb-4">
    @endif
    <div class="mt-8">
        <a href="{{ route('noticias.index') }}"
           class="text-blue-600">
            ← Volver a noticias
        </a>
    </div>

</div>

</x-public-layout>
