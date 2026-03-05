@php
    $estado = $evento->estado;
    $colorConfig = match($estado) {
        'en_curso' => ['color' => 'green', 'badge' => 'En Curso', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
        'proximo' => ['color' => 'blue', 'badge' => 'Próximo', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
        'finalizado' => ['color' => 'gray', 'badge' => 'Finalizado', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        default => ['color' => 'blue', 'badge' => 'Evento', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z']
    };
@endphp

<a href="{{ route('eventos.show', $evento->slug) }}" 
   class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" 
   style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
    
    {{-- Efecto hover --}}
    <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" 
         style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 75%);"></div>
    
    {{-- Imagen portada --}}
    <div class="relative overflow-hidden h-48">
        @if($evento->imagen_portada)
            <img src="{{ asset('storage/' . $evento->imagen_portada) }}"
                 alt="{{ $evento->titulo }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-500/20 to-blue-700/20 flex items-center justify-center">
                <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        {{-- Overlay gradiente --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

        {{-- Badge destacado (si aplica) --}}
        @if($evento->destacado)
            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center gap-1 px-2 py-1 bg-purple-500 text-white text-xs font-bold rounded-lg shadow-lg">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Destacado
                </span>
            </div>
        @endif
    </div>

    <div class="relative p-6">
        {{-- Icono y badge estado --}}
        <div class="mb-4 flex items-center justify-between">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-{{ $colorConfig['color'] }}-500 to-{{ $colorConfig['color'] }}-700 flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $colorConfig['icon'] }}"/>
                </svg>
            </div>
            <span class="px-3 py-1 bg-{{ $colorConfig['color'] }}-500/20 text-{{ $colorConfig['color'] }}-300 text-xs font-bold rounded-lg border border-{{ $colorConfig['color'] }}-500/40">
                {{ $colorConfig['badge'] }}
            </span>
        </div>

        {{-- Título --}}
        <h3 class="text-xl font-bold text-white mb-3 leading-tight group-hover:text-blue-300 transition-colors duration-300 line-clamp-2">
            {{ $evento->titulo }}
        </h3>

        {{-- Descripción --}}
        @if($evento->descripcion)
            <p class="text-white/70 text-sm leading-relaxed mb-4 line-clamp-2">
                {{ $evento->descripcion }}
            </p>
        @endif

        {{-- Metadata: fecha y lugar --}}
        <div class="flex flex-col gap-2 mb-4">
            @if($evento->fecha_inicio)
                <div class="flex items-center gap-2 text-white/80 text-sm">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="truncate">
                        {{ $evento->fecha_inicio->format('d M Y') }}
                        @if($evento->fecha_fin && !$evento->fecha_inicio->isSameDay($evento->fecha_fin))
                            — {{ $evento->fecha_fin->format('d M Y') }}
                        @endif
                    </span>
                </div>
            @endif

            @if($evento->lugar)
                <div class="flex items-center gap-2 text-white/80 text-sm">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="truncate">{{ $evento->lugar }}</span>
                </div>
            @endif

            @if($evento->galeria->count())
                <div class="flex items-center gap-2 text-purple-300 text-sm">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $evento->galeria->count() }} foto(s)</span>
                </div>
            @endif
        </div>

        {{-- Flecha indicador --}}
        <div class="flex items-center gap-2 text-blue-300 text-sm font-bold">
            <span>Ver detalles</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </div>
</a>
