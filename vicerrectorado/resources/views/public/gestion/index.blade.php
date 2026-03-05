<x-public-layout>

{{-- Fondo oscuro institucional --}}
<div id="top" class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 30%, rgba(30,58,138,0.90) 60%, rgba(15,23,42,0.93) 100%);">
    
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
        <div class="mb-12 text-center">
            
            <h1 class="text-5xl md:text-6xl font-black text-white leading-tight mb-6" style="letter-spacing: -1px;">
                Gestión Académica
            </h1>
            <p class="text-lg text-blue-100/80 leading-relaxed max-w-2xl mx-auto">
                Accede a reglamentos, directivas, formatos y documentos académicos institucionales
            </p>
            
            
        </div>

        {{-- Navegación rápida por categorías --}}
        @if($documentos->isNotEmpty())
            <div class="mb-12">
                <div class="p-6 rounded-2xl" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Navegación Rápida</h3>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach($documentos as $tipo => $items)
                            @php
                                $colorConfig = match(strtolower($tipo)) {
                                    'reglamento', 'reglamentos' => ['bg' => 'from-red-500 to-red-600', 'hover' => 'hover:from-red-600 hover:to-red-700'],
                                    'directiva', 'directivas' => ['bg' => 'from-amber-500 to-amber-600', 'hover' => 'hover:from-amber-600 hover:to-amber-700'],
                                    'formato', 'formatos' => ['bg' => 'from-green-500 to-green-600', 'hover' => 'hover:from-green-600 hover:to-green-700'],
                                    'manual', 'manuales' => ['bg' => 'from-purple-500 to-purple-600', 'hover' => 'hover:from-purple-600 hover:to-purple-700'],
                                    'guia', 'guias' => ['bg' => 'from-cyan-500 to-cyan-600', 'hover' => 'hover:from-cyan-600 hover:to-cyan-700'],
                                    default => ['bg' => 'from-blue-500 to-blue-600', 'hover' => 'hover:from-blue-600 hover:to-blue-700'],
                                };
                            @endphp
                            <a href="#{{ Str::slug($tipo) }}" 
                               class="group inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r {{ $colorConfig['bg'] }} {{ $colorConfig['hover'] }} text-white rounded-lg font-semibold text-sm transition-all duration-300 hover:shadow-lg hover:scale-105">
                                <span class="capitalize">{{ str_replace('_', ' ', $tipo) }}</span>
                                <span class="px-2 py-0.5 bg-white/20 rounded-md text-xs font-bold">{{ count($items) }}</span>
                                <svg class="w-4 h-4 opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Secciones por tipo de documento --}}
        @foreach($documentos as $tipo => $items)
            
            <div id="{{ Str::slug($tipo) }}" class="mb-16 scroll-mt-24">
                {{-- Header de sección estilo estructura --}}
                <div class="flex items-center gap-3 mb-8">
                    @php
                        $colorConfig = match(strtolower($tipo)) {
                            'reglamento', 'reglamentos' => 'from-red-400 to-red-600',
                            'directiva', 'directivas' => 'from-amber-400 to-amber-600',
                            'formato', 'formatos' => 'from-green-400 to-green-600',
                            'manual', 'manuales' => 'from-purple-400 to-purple-600',
                            'guia', 'guias' => 'from-cyan-400 to-cyan-600',
                            default => 'from-blue-400 to-blue-600',
                        };
                    @endphp
                    <div class="w-1 h-10 bg-gradient-to-b {{ $colorConfig }} rounded-full shadow-lg"></div>
                    <div class="flex-1">
                        <h2 class="text-3xl md:text-4xl font-black text-white capitalize leading-tight">
                            {{ str_replace('_', ' ', $tipo) }}
                        </h2>
                        <p class="text-white/60 text-sm mt-1">
                            {{ count($items) }} {{ count($items) == 1 ? 'documento disponible' : 'documentos disponibles' }}
                        </p>
                    </div>
                    <a href="#top" class="hidden lg:flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 backdrop-blur-sm text-white/70 hover:text-white text-xs font-semibold rounded-lg border border-white/10 hover:border-white/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                        </svg>
                        <span>Volver arriba</span>
                    </a>
                </div>

                {{-- Grid de documentos estilo estructura --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $doc)
                        <div class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                            
                            {{-- Efecto hover sutil --}}
                            <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 75%);"></div>
                            
                            <div class="relative p-6">
                                {{-- Header con icono --}}
                                <div class="mb-4 flex items-center justify-between">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-blue-300 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3"/>
                                    </svg>
                                </div>

                                {{-- Título --}}
                                <h3 class="text-xl font-bold text-white mb-3 leading-tight">
                                    {{ $doc->titulo }}
                                </h3>

                                {{-- Metadata --}}
                                @if($doc->fecha_publicacion)
                                    <div class="flex items-center gap-2 mb-3 text-white/60 text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $doc->fecha_publicacion }}</span>
                                    </div>
                                @endif

                                {{-- Descripción --}}
                                <p class="text-white/70 text-sm leading-relaxed mb-4">
                                    {{ \Illuminate\Support\Str::limit($doc->descripcion ?? 'Documento disponible para descarga', 100) }}
                                </p>

                                {{-- Acciones --}}
                                @if($doc->archivo)
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $doc->archivo) }}"
                                           download
                                           class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span>Descargar</span>
                                        </a>
                                        
                                        <a href="{{ asset('storage/' . $doc->archivo) }}"
                                           target="_blank"
                                           class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all duration-300 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- Separador entre secciones --}}
                @if(!$loop->last)
                    <div class="mt-12 flex items-center gap-4">
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                        <div class="flex gap-1">
                            <div class="w-1 h-1 rounded-full bg-white/30"></div>
                            <div class="w-1 h-1 rounded-full bg-white/30"></div>
                            <div class="w-1 h-1 rounded-full bg-white/30"></div>
                        </div>
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                    </div>
                @endif
            </div>

        @endforeach

        {{-- Mensaje si no hay documentos --}}
        @if($documentos->isEmpty())
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-2xl mb-6" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px); border: 2px solid rgba(255,255,255,0.15);">
                    <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-white mb-3">No hay documentos disponibles</h3>
                <p class="text-white/70 text-base max-w-md mx-auto">
                    Los documentos académicos estarán disponibles próximamente. Vuelve a consultar más tarde.
                </p>
            </div>
        @endif

    </div>
</div>

{{-- Botón flotante volver arriba (móvil) --}}
<a href="#top" 
   class="lg:hidden fixed bottom-6 right-6 z-50 w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110"
   aria-label="Volver arriba">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
    </svg>
</a>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

</x-public-layout>