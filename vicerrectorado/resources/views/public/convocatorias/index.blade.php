<x-public-layout>

{{-- Fondo oscuro institucional --}}
<div class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 30%, rgba(30,58,138,0.90) 60%, rgba(15,23,42,0.93) 100%);">
    
    {{-- Decoración de fondo --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 80% 30%, rgba(59,130,246,0.15) 0%, transparent 65%);"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96" style="background: radial-gradient(ellipse at 10% 90%, rgba(99,102,241,0.12) 0%, transparent 60%);"></div>
    </div>

    {{-- Círculos decorativos --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full opacity-15 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-700 rounded-full opacity-20 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        {{-- Header institucional --}}
        <div class="mb-16 text-center">
            <h1 class="text-5xl md:text-6xl font-black text-white leading-tight mb-6" style="letter-spacing: -1px;">
                Convocatorias
            </h1>
            <p class="text-lg text-blue-100/80 leading-relaxed max-w-2xl mx-auto">
                Descubre las convocatorias disponibles y oportunidades académicas de nuestra institución
            </p>
        </div>

        {{-- CONVOCATORIAS ABIERTAS --}}
        @if($abiertas->count())
            <div class="mb-16">
                {{-- Header de sección --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-green-400 to-green-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Convocatorias Abiertas
                    </h2>
                    <span class="px-3 py-1 bg-green-500/20 text-green-300 text-sm font-bold rounded-lg border border-green-500/30">
                        {{ $abiertas->count() }} {{ $abiertas->count() === 1 ? 'convocatoria' : 'convocatorias' }}
                    </span>
                </div>

                {{-- Grid de convocatorias --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($abiertas as $c)
                        <a href="{{ route('convocatorias.show', $c) }}" class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                            
                            {{-- Efecto hover --}}
                            <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(34,197,94,0.12) 0%, transparent 75%);"></div>
                            
                            <div class="relative p-6">
                                {{-- Icono y badge estado --}}
                                <div class="mb-4 flex items-center justify-between">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <span class="px-3 py-1 bg-green-500/20 text-green-300 text-xs font-bold rounded-lg border border-green-500/40">
                                        Abierta
                                    </span>
                                </div>

                                {{-- Título --}}
                                <h3 class="text-xl font-bold text-white mb-3 leading-tight group-hover:text-green-300 transition-colors duration-300">
                                    {{ $c->titulo }}
                                </h3>

                                {{-- Descripción si existe --}}
                                @if($c->descripcion)
                                    <p class="text-white/70 text-sm leading-relaxed mb-4 line-clamp-2">
                                        {{ $c->descripcion }}
                                    </p>
                                @endif

                                {{-- Fechas --}}
                                <div class="flex flex-col gap-2 mb-4">
                                    <div class="flex items-center gap-2 text-white/80 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Cierra: {{ $c->fecha_cierre->format('d/m/Y') }}</span>
                                    </div>
                                </div>

                                {{-- Flecha indicador --}}
                                <div class="flex items-center gap-2 text-green-300 text-sm font-bold">
                                    <span>Ver detalles</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- PRÓXIMAS CONVOCATORIAS --}}
        @if($proximas->count())
            <div class="mb-16">
                {{-- Header de sección --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-indigo-400 to-indigo-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Próximas Convocatorias
                    </h2>
                    <span class="px-3 py-1 bg-indigo-500/20 text-indigo-300 text-sm font-bold rounded-lg border border-indigo-500/30">
                        {{ $proximas->count() }} {{ $proximas->count() === 1 ? 'convocatoria' : 'convocatorias' }}
                    </span>
                </div>

                {{-- Grid de convocatorias --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($proximas as $c)
                        <a href="{{ route('convocatorias.show', $c) }}" class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                            
                            {{-- Efecto hover --}}
                            <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(99,102,241,0.12) 0%, transparent 75%);"></div>
                            
                            <div class="relative p-6">
                                {{-- Icono y badge estado --}}
                                <div class="mb-4 flex items-center justify-between">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="px-3 py-1 bg-indigo-500/20 text-indigo-300 text-xs font-bold rounded-lg border border-indigo-500/40">
                                        Próxima
                                    </span>
                                </div>

                                {{-- Título --}}
                                <h3 class="text-xl font-bold text-white mb-3 leading-tight group-hover:text-indigo-300 transition-colors duration-300">
                                    {{ $c->titulo }}
                                </h3>

                                {{-- Descripción si existe --}}
                                @if($c->descripcion)
                                    <p class="text-white/70 text-sm leading-relaxed mb-4 line-clamp-2">
                                        {{ $c->descripcion }}
                                    </p>
                                @endif

                                {{-- Fechas --}}
                                <div class="flex flex-col gap-2 mb-4">
                                    <div class="flex items-center gap-2 text-white/80 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Inicia: {{ $c->fecha_inicio->format('d/m/Y') }}</span>
                                    </div>
                                </div>

                                {{-- Flecha indicador --}}
                                <div class="flex items-center gap-2 text-indigo-300 text-sm font-bold">
                                    <span>Ver detalles</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- CONVOCATORIAS CERRADAS --}}
        @if($cerradas->count())
            <div class="mb-16">
                {{-- Header de sección --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-red-400 to-red-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Convocatorias Cerradas
                    </h2>
                    <span class="px-3 py-1 bg-red-500/20 text-red-300 text-sm font-bold rounded-lg border border-red-500/30">
                        {{ $cerradas->count() }} {{ $cerradas->count() === 1 ? 'convocatoria' : 'convocatorias' }}
                    </span>
                </div>

                {{-- Grid de convocatorias --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($cerradas as $c)
                        <div class="group relative rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); opacity: 0.7;">
                            
                            <div class="relative p-6">
                                {{-- Icono y badge estado --}}
                                <div class="mb-4 flex items-center justify-between">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <span class="px-3 py-1 bg-red-500/20 text-red-300 text-xs font-bold rounded-lg border border-red-500/40">
                                        Cerrada
                                    </span>
                                </div>

                                {{-- Título --}}
                                <h3 class="text-xl font-bold text-white/80 mb-3 leading-tight">
                                    {{ $c->titulo }}
                                </h3>

                                {{-- Descripción si existe --}}
                                @if($c->descripcion)
                                    <p class="text-white/50 text-sm leading-relaxed mb-4 line-clamp-2">
                                        {{ $c->descripcion }}
                                    </p>
                                @endif

                                {{-- Fechas --}}
                                <div class="flex flex-col gap-2 mb-4">
                                    <div class="flex items-center gap-2 text-white/60 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Cerró: {{ $c->fecha_cierre->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Mensaje si no hay convocatorias --}}
        @if($abiertas->isEmpty() && $proximas->isEmpty() && $cerradas->isEmpty())
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-2xl mb-6" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px); border: 2px solid rgba(255,255,255,0.15);">
                    <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-white mb-3">No hay convocatorias disponibles</h3>
                <p class="text-white/70 text-base max-w-md mx-auto">
                    Las convocatorias estarán disponibles próximamente. Vuelve a consultar más tarde.
                </p>
            </div>
        @endif

    </div>
</div>

</x-public-layout>