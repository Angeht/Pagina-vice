<x-public-layout>

{{-- Fondo oscuro con degradados como en home --}}
<div class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 30%, rgba(30,58,138,0.90) 60%, rgba(15,23,42,0.93) 100%);">
    
    {{-- Decoración de fondo --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 80% 30%, rgba(59,130,246,0.15) 0%, transparent 65%);"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96" style="background: radial-gradient(ellipse at 10% 90%, rgba(99,102,241,0.12) 0%, transparent 60%);"></div>
    </div>

    {{-- Círculos decorativos difuminados --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full opacity-15 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-700 rounded-full opacity-20 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        {{-- Header estilo home --}}
        <div class="mb-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-4 drop-shadow-md">
                Noticias
            </h1>
            <p class="text-white/90 text-lg max-w-2xl mx-auto font-medium drop-shadow">Mantente informado con las últimas novedades y acontecimientos</p>
        </div>

        {{-- Filtro de Categorías con estilo glass morphism --}}
        <div class="mb-10">
            <div class="flex flex-wrap gap-3 justify-center items-center">
                <a href="{{ route('noticias.index') }}"
                   class="group relative flex flex-col items-center justify-center gap-3 rounded-2xl transition-all duration-300 px-6 py-3"
                   style="background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.20) 0%, transparent 75%);"></div>
                    <span class="relative font-bold text-sm text-white/90 group-hover:text-white transition-colors">
                        Todas
                    </span>
                </a>

                @foreach(\App\Models\Categoria::all() as $categoria)
                    <a href="{{ route('noticias.index', ['categoria' => $categoria->slug]) }}"
                       class="group relative flex flex-col items-center justify-center gap-3 rounded-2xl transition-all duration-300 px-6 py-3 hover:scale-105"
                       style="background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1);">
                        <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.25) 0%, transparent 75%);"></div>
                        <span class="relative font-bold text-sm text-white/90 group-hover:text-white transition-colors">
                            {{ $categoria->nombre }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Grid de Noticias estilo estructura --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($noticias as $noticia)
                <a href="{{ route('noticias.show', $noticia) }}"
                   class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                    
                    {{-- Efecto hover sutil --}}
                    <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 75%);"></div>
                    
                    {{-- Imagen de la noticia --}}
                    @if($noticia->imagen)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $noticia->imagen) }}"
                                alt="{{ $noticia->titulo }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            {{-- Icono flotante sobre la imagen --}}
                            <div class="absolute top-4 left-4 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>

                            {{-- Badge de categoría --}}
                            @if($noticia->categoria)
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1.5 bg-blue-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg">{{ $noticia->categoria->nombre }}</span>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="relative h-48 bg-gradient-to-br from-slate-700 to-blue-700 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            {{-- Badge de categoría --}}
                            @if($noticia->categoria)
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1.5 bg-blue-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg">{{ $noticia->categoria->nombre }}</span>
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    <div class="relative p-6">
                        {{-- Fecha y autor destacado --}}
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex-shrink-0 bg-blue-500/20 backdrop-blur-sm rounded-lg px-3 py-2 border border-blue-400/30">
                                <div class="text-center">
                                    <div class="text-2xl font-black text-blue-300">{{ $noticia->created_at->format('d') }}</div>
                                    <div class="text-xs font-bold text-blue-400 uppercase">{{ $noticia->created_at->format('M') }}</div>
                                </div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 text-sm text-blue-300 font-semibold mb-1">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $noticia->created_at->format('d/m/Y') }}</span>
                                </div>
                                @if($noticia->autor || $noticia->categoria)
                                    <div class="flex items-center gap-2 text-xs text-white/60">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="truncate">{{ $noticia->autor ?? 'Vicerrectorado Académico' }}</span>
                                    </div>
                                @endif
                            </div>

                            <svg class="w-5 h-5 text-blue-300 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-3 leading-tight line-clamp-2">
                            {{ $noticia->titulo }}
                        </h3>

                        @if($noticia->resumen || $noticia->contenido)
                            <p class="text-white/70 text-sm leading-relaxed line-clamp-2">
                                {{ \Illuminate\Support\Str::limit($noticia->resumen ?? strip_tags($noticia->contenido), 100) }}
                            </p>
                        @endif
                    </div>
                </a>
            @endforeach

        </div>

        {{-- Paginación --}}
        <div class="mt-12">
            {{ $noticias->links() }}
        </div>

    </div>
</div>

</x-public-layout>
