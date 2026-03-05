<x-public-layout>

{{-- Fondo oscuro institucional --}}
<div class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 30%, rgba(30,58,138,0.90) 60%, rgba(15,23,42,0.93) 100%);">
    
    {{-- Decoración de fondo --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 80% 30%, rgba(59,130,246,0.15) 0%, transparent 65%);"></div>
    </div>

    {{-- Círculos decorativos --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full opacity-15 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        {{-- Botón volver --}}
        <a href="{{ route('noticias.index') }}" class="inline-flex items-center gap-2 text-blue-300 hover:text-blue-200 mb-8 transition-colors duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="font-semibold">Volver a noticias</span>
        </a>

        {{-- Badge de categoría --}}
        @if($noticia->categoria)
            <div class="mb-6">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/20 text-blue-300 text-sm font-bold rounded-lg border border-blue-500/40">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    {{ $noticia->categoria->nombre }}
                </span>
            </div>
        @endif

        {{-- Título --}}
        <h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-6" style="letter-spacing: -1px;">
            {{ $noticia->titulo }}
        </h1>

        {{-- Metadata --}}
        <div class="flex flex-wrap gap-4 mb-8 text-white/70">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-sm font-medium">{{ $noticia->created_at->format('d/m/Y') }}</span>
            </div>

            @if($noticia->autor)
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ $noticia->autor }}</span>
                </div>
            @endif
        </div>

        {{-- Grid: Resumen (izquierda) e Imagen (derecha) --}}
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            
            {{-- Resumen destacado (izquierda) --}}
            @if($noticia->resumen)
                <div class="rounded-2xl overflow-hidden h-fit" style="background: rgba(59,130,246,0.1); backdrop-filter: blur(16px); border: 1px solid rgba(59,130,246,0.2);">
                    <div class="p-6">
                        <div class="flex gap-3">
                            <svg class="w-6 h-6 text-blue-300 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="text-white font-bold text-lg mb-3">Resumen</h3>
                                <p class="text-white/90 text-base leading-relaxed">
                                    {{ $noticia->resumen }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Imagen principal (derecha) --}}
            @if($noticia->imagen)
                <div class="rounded-2xl overflow-hidden shadow-2xl bg-gray-900">
                    <img src="{{ asset('storage/' . $noticia->imagen) }}"
                         alt="{{ $noticia->titulo }}"
                         class="w-full h-full object-cover min-h-[320px] max-h-[400px]">
                </div>
            @endif

        </div>

        {{-- Contenido completo (abajo, ancho completo) --}}
        <div class="rounded-2xl overflow-hidden mb-8" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Detalles Completos</h2>
                <div class="prose prose-lg prose-invert max-w-none">
                    <div class="text-white/90 leading-relaxed space-y-4" style="font-size: 1.05rem; line-height: 1.8;">
                        {!! nl2br(e($noticia->contenido)) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer con compartir y acciones --}}
        <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
            <div class="p-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h3 class="text-white font-bold mb-2">Compartir esta noticia</h3>
                        <div class="flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($noticia->titulo) }}"
                               target="_blank"
                               class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white text-sm font-bold rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($noticia->titulo . ' ' . request()->url()) }}"
                               target="_blank"
                               class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                WhatsApp
                            </a>
                        </div>
                    </div>

                    @if($noticia->categoria)
                        <div class="text-right">
                            <p class="text-white/60 text-sm mb-2">Más noticias de:</p>
                            <a href="{{ route('noticias.index', ['categoria' => $noticia->categoria->slug]) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 text-sm font-bold rounded-lg border border-blue-500/40 transition-colors duration-300">
                                {{ $noticia->categoria->nombre }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

</x-public-layout>
