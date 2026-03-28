<x-public-layout><div class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 30%, rgba(30,58,138,0.90) 60%, rgba(15,23,42,0.93) 100%);"><div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 80% 30%, rgba(59,130,246,0.15) 0%, transparent 65%);"></div>
    </div><div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full opacity-15 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20"><a href="{{ route('eventos.index') }}" class="inline-flex items-center gap-2 text-blue-300 hover:text-blue-200 mb-8 transition-colors duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="font-semibold">Volver a eventos</span>
        </a><div class="flex flex-wrap gap-2 mb-6">
            @php 
                $estado = $evento->estado;
                $badgeConfig = match($estado) {
                    'en_curso' => ['bg' => 'bg-green-500/20', 'text' => 'text-green-300', 'border' => 'border-green-500/40', 'label' => '🔴 En Curso', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                    'proximo' => ['bg' => 'bg-blue-500/20', 'text' => 'text-blue-300', 'border' => 'border-blue-500/40', 'label' => 'Próximo', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    'finalizado' => ['bg' => 'bg-gray-500/20', 'text' => 'text-gray-300', 'border' => 'border-gray-500/40', 'label' => 'Finalizado', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    default => ['bg' => 'bg-blue-500/20', 'text' => 'text-blue-300', 'border' => 'border-blue-500/40', 'label' => 'Evento', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z']
                };
            @endphp
            
            <span class="inline-flex items-center gap-2 px-4 py-2 {{ $badgeConfig['bg'] }} {{ $badgeConfig['text'] }} text-sm font-bold rounded-lg border {{ $badgeConfig['border'] }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $badgeConfig['icon'] }}"/>
                </svg>
                {{ $badgeConfig['label'] }}
            </span>

            @if($evento->destacado)
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/20 text-purple-300 text-sm font-bold rounded-lg border border-purple-500/40">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Destacado
                </span>
            @endif
        </div><h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-8" style="letter-spacing: -1px;">
            {{ $evento->titulo }}
        </h1>

        <div class="grid lg:grid-cols-3 gap-8"><div class="lg:col-span-2 space-y-8">@if($evento->imagen_portada)
                    <div class="rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('storage/' . $evento->imagen_portada) }}"
                             alt="{{ $evento->titulo }}"
                             class="w-full object-cover max-h-96">
                    </div>
                @endif@if($evento->descripcion)
                    <div class="rounded-2xl overflow-hidden" style="background: rgba(59,130,246,0.1); backdrop-filter: blur(16px); border: 1px solid rgba(59,130,246,0.2);">
                        <div class="p-6">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-white/90 text-lg leading-relaxed">
                                    {{ $evento->descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif@if($evento->contenido)
                    <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-white mb-4">Detalles del Evento</h2>
                            <div class="text-white/80 leading-relaxed text-base space-y-4">
                                {!! nl2br(e($evento->contenido)) !!}
                            </div>
                        </div>
                    </div>
                @endif

            </div><div class="space-y-6"><div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-4">Información</h3>

                        @if($evento->fecha_inicio)
                            <div class="flex gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-lg flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white/60 text-xs font-semibold mb-1">Inicio</p>
                                    <p class="text-white text-sm font-bold">{{ $evento->fecha_inicio->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($evento->fecha_fin)
                            <div class="flex gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white/60 text-xs font-semibold mb-1">Fin</p>
                                    <p class="text-white text-sm font-bold">{{ $evento->fecha_fin->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($evento->lugar)
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center shadow-lg flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white/60 text-xs font-semibold mb-1">Lugar</p>
                                    <p class="text-white text-sm font-bold">{{ $evento->lugar }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div><div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white mb-3">Compartir</h3>
                        <div class="flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="flex-1 text-center py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold transition-colors duration-300 shadow-md hover:shadow-lg">
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($evento->titulo) }}"
                               target="_blank"
                               class="flex-1 text-center py-3 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-sm font-bold transition-colors duration-300 shadow-md hover:shadow-lg">
                                Twitter
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>@if($evento->galeria->count())
            <section class="mt-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-purple-400 to-purple-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Galería de Fotos
                    </h2>
                    <span class="px-3 py-1 bg-purple-500/20 text-purple-300 text-sm font-bold rounded-lg border border-purple-500/30">
                        {{ $evento->galeria->count() }} {{ $evento->galeria->count() === 1 ? 'imagen' : 'imágenes' }}
                    </span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" id="galeria-grid">
                    @foreach($evento->galeria as $index => $img)
                        <div class="group relative rounded-xl overflow-hidden aspect-square cursor-pointer transition-all duration-300 hover:-translate-y-1" 
                             style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);"
                             onclick="openLightbox({{ $index }})">
                            <img src="{{ asset('storage/' . $img->imagen) }}"
                                 alt="{{ $img->descripcion ?? $evento->titulo }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>

                            @if($img->descripcion)
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-white text-xs truncate">{{ $img->descripcion }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div><div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4" onclick="closeLightbox(event)">
                    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-white text-4xl font-bold leading-none transition-colors duration-300 z-10">×</button>
                    <button onclick="event.stopPropagation(); prevImg();" class="absolute left-6 text-white/80 hover:text-white text-5xl font-bold leading-none select-none transition-colors duration-300 z-10">‹</button>
                    <button onclick="event.stopPropagation(); nextImg();" class="absolute right-20 text-white/80 hover:text-white text-5xl font-bold leading-none select-none transition-colors duration-300 z-10">›</button>
                    <div class="max-w-6xl max-h-full flex flex-col items-center">
                        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
                        <p id="lightbox-caption" class="text-center text-gray-300 text-base mt-4 max-w-2xl"></p>
                    </div>
                </div>

                <script>
                const imagenes = @json($evento->galeria->map(fn($i) => ['src' => asset('storage/' . $i->imagen), 'caption' => $i->descripcion ?? '']));
                let currentIndex = 0;

                function openLightbox(index = 0) {
                    currentIndex = index;
                    document.getElementById('lightbox').classList.remove('hidden');
                    document.getElementById('lightbox').classList.add('flex');
                    updateLightbox();
                    document.body.style.overflow = 'hidden';
                }

                function closeLightbox(e) {
                    if (!e || e.target === document.getElementById('lightbox') || e.target.tagName === 'BUTTON') {
                        document.getElementById('lightbox').classList.add('hidden');
                        document.getElementById('lightbox').classList.remove('flex');
                        document.body.style.overflow = '';
                    }
                }

                function updateLightbox() {
                    document.getElementById('lightbox-img').src = imagenes[currentIndex].src;
                    document.getElementById('lightbox-caption').textContent = imagenes[currentIndex].caption;
                }

                function prevImg() { 
                    currentIndex = (currentIndex - 1 + imagenes.length) % imagenes.length; 
                    updateLightbox(); 
                }
                
                function nextImg() { 
                    currentIndex = (currentIndex + 1) % imagenes.length; 
                    updateLightbox(); 
                }

                document.addEventListener('keydown', e => {
                    if (!document.getElementById('lightbox').classList.contains('hidden')) {
                        if (e.key === 'ArrowLeft')  prevImg();
                        if (e.key === 'ArrowRight') nextImg();
                        if (e.key === 'Escape')     closeLightbox({target: document.getElementById('lightbox')});
                    }
                });
                </script>
            </section>
        @endif@if($otrosEventos->count())
            <section class="mt-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-blue-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Otros Eventos
                    </h2>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($otrosEventos as $otro)
                        @include('public.eventos._card', ['evento' => $otro])
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</div>

</x-public-layout>
