<x-public-layout>

{{-- Hero Banner Institucional --}}
@php
$titulo = \App\Models\Configuracion::getValor('banner_titulo');
$subtitulo = \App\Models\Configuracion::getValor('banner_subtitulo');
$imagen = \App\Models\Configuracion::getValor('banner_imagen');
@endphp

{{-- Imagen de fondo fija para toda la página --}}
@if($imagen)
    <div class="fixed inset-0 z-0" style="pointer-events: none;">
        <img src="{{ asset('storage/' . $imagen) }}" class="w-full h-full object-cover" alt="Banner">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(15,23,42,0.40) 0%, rgba(15,23,42,0.60) 40%, rgba(15,23,42,0.85) 100%);"></div>
    </div>
@endif

<div id="hero-banner" class="relative min-h-screen flex flex-col justify-center overflow-hidden" style="background: linear-gradient(125deg, rgba(15,23,42,0.5) 0%, rgba(30,41,59,0.6) 40%, rgba(30,58,138,0.5) 70%, rgba(15,23,42,0.6) 100%);">

    @if(!$imagen)
        {{-- Fondo decorativo sin imagen --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 80% 30%, rgba(59,130,246,0.18) 0%, transparent 60%);"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96" style="background: radial-gradient(ellipse at 20% 80%, rgba(99,102,241,0.15) 0%, transparent 60%);"></div>
        </div>
    @endif

    {{-- Líneas decorativas --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-10 right-0 w-px h-64 bg-gradient-to-b from-transparent via-blue-400/30 to-transparent"></div>
        <div class="absolute top-0 right-32 w-px h-48 bg-gradient-to-b from-transparent via-blue-300/20 to-transparent"></div>
        <div class="absolute bottom-40 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent"></div>
        <div class="absolute top-1/3 right-1/4 w-72 h-72 border border-blue-500/10 rounded-full"></div>
        <div class="absolute top-1/3 right-1/4 w-48 h-48 mt-12 mr-12 border border-blue-400/10 rounded-full"></div>
        {{-- Puntos decorativos --}}
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, rgba(255,255,255,0.6) 1px, transparent 1px); background-size: 60px 60px;"></div>
    </div>

    {{-- Logo VRA con los mismos márgenes del contenedor principal --}}
    <div class="absolute inset-0 pointer-events-none z-5">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="absolute top-1/2 right-0 transform -translate-y-1/2 pointer-events-auto">
                <div class="sticky top-24">
                    <img src="{{ asset('images/institucional/logo-vra.png') }}" 
                         alt="Logo Vicerrectorado Académico" 
                         class="h-96 lg:h-[28rem] w-auto opacity-90 drop-shadow-2xl animate-[fadeInScale_1.2s_ease-out]">
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 0.9;
                transform: scale(1);
            }
        }
    </style>

    {{-- Contenido principal --}}
    <div class="relative max-w-8xl mx-auto px-4 sm:px-6 lg:px-10 py-24 lg:py-1 w-full">
        <div class="max-w-2xl">
            {{-- Badge institucional --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-blue-400/30 bg-blue-500/10 mb-8">
                <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                <span class="text-blue-300 text-xs font-bold uppercase tracking-widest">Universidad · Vicerrectorado Académico</span>
            </div>

            {{-- Contenedor con fondo para mejorar contraste --}}
            <div class="bg-slate-900/40 backdrop-blur-sm rounded-2xl p-8 border border-white/10 shadow-2xl">
                {{-- Título --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-6" style="letter-spacing: -1px;">
                    {{ $titulo ?? 'Vicerrectorado Académico' }}
                </h1>

                {{-- Línea decorativa --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-1 w-16 bg-blue-400 rounded-full"></div>
                    <div class="h-1 w-6 bg-blue-600 rounded-full"></div>
                    <div class="h-1 w-3 bg-blue-800 rounded-full"></div>
                </div>

                {{-- Subtítulo --}}
                <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-xl">
                    {{ $subtitulo ?? 'Comprometidos con la excelencia académica y la formación integral de nuestra comunidad universitaria.' }}
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     BARRA DE ACCESO RÁPIDO - Enlaces Directos Renovado
══════════════════════════════════════════════════════════════ --}}
<section class="relative z-10 py-8 overflow-hidden" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.94) 50%, rgba(30,58,138,0.92) 100%); backdrop-filter: blur(12px);">
    
    {{-- Decoración de fondo --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>
    
    {{-- Líneas decorativas --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Enlace: Convocatorias --}}
            <a href="{{ route('convocatorias.index') }}" 
               class="group relative overflow-hidden bg-white/5 backdrop-blur-md hover:bg-white/10 rounded-xl border border-white/10 hover:border-blue-400/50 transition-all duration-500 shadow-lg hover:shadow-xl hover:shadow-blue-500/20 hover:-translate-y-1">
                {{-- Gradiente hover --}}
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-blue-600/0 group-hover:from-blue-500/10 group-hover:to-blue-600/5 transition-all duration-500"></div>
                
                <div class="relative p-4 flex items-center gap-4">
                    {{-- Icono compacto --}}
                    <div class="relative flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-500 shadow-lg shadow-blue-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    {{-- Contenido --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-white text-sm group-hover:text-blue-300 transition-colors truncate">Convocatorias</h3>
                        <p class="text-xs text-blue-200/70">Abiertas ahora</p>
                    </div>
                    
                    {{-- Flecha --}}
                    <svg class="w-4 h-4 text-blue-400 group-hover:text-blue-300 group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Enlace: Gestión Académica --}}
            <a href="{{ route('gestion.index') }}" 
               class="group relative overflow-hidden bg-white/5 backdrop-blur-md hover:bg-white/10 rounded-xl border border-white/10 hover:border-emerald-400/50 transition-all duration-500 shadow-lg hover:shadow-xl hover:shadow-emerald-500/20 hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/0 to-emerald-600/0 group-hover:from-emerald-500/10 group-hover:to-emerald-600/5 transition-all duration-500"></div>
                
                <div class="relative p-4 flex items-center gap-4">
                    <div class="relative flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-500 shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-white text-sm group-hover:text-emerald-300 transition-colors truncate">Documentos</h3>
                        <p class="text-xs text-emerald-200/70">Gestión académica</p>
                    </div>
                    
                    <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Enlace: Autoridades --}}
            <a href="{{ route('autoridades.index') }}" 
               class="group relative overflow-hidden bg-white/5 backdrop-blur-md hover:bg-white/10 rounded-xl border border-white/10 hover:border-indigo-400/50 transition-all duration-500 shadow-lg hover:shadow-xl hover:shadow-indigo-500/20 hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/0 to-indigo-600/0 group-hover:from-indigo-500/10 group-hover:to-indigo-600/5 transition-all duration-500"></div>
                
                <div class="relative p-4 flex items-center gap-4">
                    <div class="relative flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-500 shadow-lg shadow-indigo-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-white text-sm group-hover:text-indigo-300 transition-colors truncate">Autoridades</h3>
                        <p class="text-xs text-indigo-200/70">Equipo directivo</p>
                    </div>
                    
                    <svg class="w-4 h-4 text-indigo-400 group-hover:text-indigo-300 group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Enlace: Estructura --}}
            <a href="{{ route('estructura.index') }}" 
               class="group relative overflow-hidden bg-white/5 backdrop-blur-md hover:bg-white/10 rounded-xl border border-white/10 hover:border-purple-400/50 transition-all duration-500 shadow-lg hover:shadow-xl hover:shadow-purple-500/20 hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/0 to-purple-600/0 group-hover:from-purple-500/10 group-hover:to-purple-600/5 transition-all duration-500"></div>
                
                <div class="relative p-4 flex items-center gap-4">
                    <div class="relative flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-500 shadow-lg shadow-purple-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-white text-sm group-hover:text-purple-300 transition-colors truncate">Estructura</h3>
                        <p class="text-xs text-purple-200/70">Organizacional</p>
                    </div>
                    
                    <svg class="w-4 h-4 text-purple-400 group-hover:text-purple-300 group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

        </div>
    </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     SECCIÓN VICERRECTOR
══════════════════════════════════════════════════════════════ --}}
@php
    $vrNombre = \App\Models\Configuracion::getValor('vicerrector_nombre');
    $vrCargo  = \App\Models\Configuracion::getValor('vicerrector_cargo');
    $vrTexto  = \App\Models\Configuracion::getValor('vicerrector_texto');
    $vrCita   = \App\Models\Configuracion::getValor('vicerrector_cita');
    $vrImagen = \App\Models\Configuracion::getValor('vicerrector_imagen');
@endphp

@if($vrNombre || $vrTexto)
{{-- ══════════════════════════════════════════════════════════════
     SECCIÓN VICERRECTOR ACADÉMICO - DISEÑO EQUILIBRADO
══════════════════════════════════════════════════════════════ --}}
<section class="reveal relative z-10 overflow-hidden py-24 lg:py-10" style="background: linear-gradient(180deg, rgba(15,23,42,0.94) 0%, rgba(25,35,55,0.96) 50%, rgba(15,23,42,0.94) 100%); backdrop-filter: blur(10px);">
    
    {{-- Fondo minimalista --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute inset-0 opacity-[0.02]" style="background-image: 
            linear-gradient(rgba(59,130,246,0.3) 1px, transparent 1px),
            linear-gradient(90deg, rgba(59,130,246,0.3) 1px, transparent 1px);
            background-size: 100px 100px;"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-blue-600/5 blur-[100px]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header simple --}}
       

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
            
            {{-- ══ COLUMNA IZQUIERDA: Foto Institucional ══ --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    @if($vrImagen)
                        <div class="relative group">
                            {{-- Imagen con bordes elegantes --}}
                            <div class="relative overflow-hidden shadow-2xl border-4 border-slate-700/50">
                                <img src="{{ asset('storage/' . $vrImagen) }}"
                                     alt="{{ $vrNombre }}"
                                     class="w-full h-[650px] lg:h-[800px] object-cover object-top"
                                     style="filter: contrast(1.05) brightness(0.98) saturate(0.95);">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/30 to-transparent"></div>
                                
                                {{-- Borde interior sutil --}}
                                <div class="absolute inset-2 border-2 border-white/10 pointer-events-none"></div>
                            </div>
                            
                        </div>
                    @else
                        <div class="relative bg-gradient-to-br from-slate-700 to-slate-800 h-[650px] lg:h-[800px] flex items-center justify-center border-4 border-slate-700/50">
                            <svg class="w-32 h-32 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ══ COLUMNA DERECHA: Contenido ══ --}}
            <div class="lg:col-span-1 space-y-8">
                
                {{-- Nombre y cargo --}}
                <div class="space-y-5">
                    <div class="border-l-4 border-blue-600 pl-5 space-y-3">
                        @if($vrNombre)
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight">
                                {{ $vrNombre }}
                            </h1>
                        @endif
                        @if($vrCargo)
                            <p class="text-blue-300 text-xl font-semibold">{{ $vrCargo }}</p>
                            @endif
                    </div>
                </div>

                {{-- Separador --}}
                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-blue-500/20"></div>
                    <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div>
                    <div class="h-px flex-1 bg-blue-500/20"></div>
                </div>

                {{-- Texto --}}
                @if($vrTexto)
                    <div class="text-gray-300 leading-relaxed space-y-4 text-base lg:text-lg">
                        @foreach(array_filter(array_map('trim', explode("\n", $vrTexto))) as $parrafo)
                            @if(trim($parrafo))
                                <p class="text-justify">{{ $parrafo }}</p>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- Cita --}}
                @if($vrCita)
                    <div class="relative pl-6 pr-4 py-6 bg-slate-800/40 border-l-4 border-blue-600">
                        <svg class="absolute top-4 left-2 w-5 h-5 text-blue-600/40" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-gray-200 text-lg italic leading-relaxed">
                            {{ $vrCita }}
                        </p>
                    </div>
                @endif

                {{-- Botón --}}
                <div class="pt-6">
                    <a href="{{ route('autoridades.index') }}" 
                       class="group inline-flex items-center gap-3 px-8 py-4 bg-blue-700 hover:bg-blue-600 text-white font-semibold uppercase tracking-wider text-sm shadow-lg hover:shadow-xl transition-all">
                        <span>Conocer más autoridades</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                    <div class="mt-4 bg-slate-800/40 backdrop-blur-sm border-l-4 border-blue-600 p-4">
                      <div class="flex items-center gap-3">
                          <div class="flex-shrink-0 w-10 h-10 bg-blue-700 flex items-center justify-center">
                             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                         </svg>
                   </div>
                        <div class="flex-1">
                      <div class="text-blue-300 font-bold text-xs uppercase">Universidad Nacional</div>
                     <div class="text-white font-semibold text-sm">Santiago Antúnez de Mayolo</div>
                       </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
                

</section>
@endif
{{-- ══════════════════════════════════════════════════════════════
     SECCIÓN EVENTOS Y MOMENTOS DESTACADOS
══════════════════════════════════════════════════════════════ --}}
@if($eventosDestacados->count())
<section class="reveal relative z-10 overflow-hidden py-10" style="background: linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,41,59,0.88) 30%, rgba(30,58,138,0.85) 60%, rgba(15,23,42,0.90) 100%); backdrop-filter: blur(8px);">
    
    {{-- Fondo de color con opacidad --}}
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950/30 via-slate-900/20 to-blue-950/25 pointer-events-none"></div>
    
    {{-- Decoración de fondo --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full opacity-15 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-700 rounded-full opacity-20 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div class="text-center flex-1">
                <h2 class="text-4xl md:text-5xl font-black text-white mb-4 drop-shadow-md">Eventos Académicos</h2>
                <p class="text-white/90 text-lg max-w-2xl mx-auto font-medium drop-shadow">Descubre las actividades y celebraciones que enriquecen nuestra comunidad universitaria</p>
            </div>
            <a href="{{ route('eventos.index') }}" class="hidden lg:flex px-5 py-2.5 border-2 border-white text-white rounded-xl hover:bg-white hover:text-blue-600 transition-all font-bold text-sm items-center gap-2 shadow-md hover:shadow-lg backdrop-blur-sm">
                Ver todos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($eventosDestacados as $evento)
                <a href="{{ route('eventos.show', $evento->slug) }}"
                   class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                    
                    {{-- Efecto hover sutil --}}
                    <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 75%);"></div>
                    
                    {{-- Imagen del evento --}}
                    @if($evento->imagen_portada)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $evento->imagen_portada) }}" 
                                 alt="{{ $evento->titulo }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            {{-- Icono flotante sobre la imagen --}}
                            <div class="absolute top-4 left-4 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>

                            {{-- Badge de estado --}}
                            <div class="absolute top-4 right-4">
                                @if($evento->estado === 'proximo')
                                    <span class="px-3 py-1.5 bg-blue-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg">Próximo</span>
                                @elseif($evento->estado === 'en_curso')
                                    <span class="px-3 py-1.5 bg-green-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg animate-pulse">En curso</span>
                                @else
                                    <span class="px-3 py-1.5 bg-gray-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg">Finalizado</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="relative h-48 bg-gradient-to-br from-slate-700 to-blue-700 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="absolute top-4 right-4">
                                @if($evento->estado === 'proximo')
                                    <span class="px-3 py-1.5 bg-blue-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg">Próximo</span>
                                @elseif($evento->estado === 'en_curso')
                                    <span class="px-3 py-1.5 bg-green-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg animate-pulse">En curso</span>
                                @else
                                    <span class="px-3 py-1.5 bg-gray-500/90 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg">Finalizado</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <div class="relative p-6">
                        {{-- Fecha y hora destacada --}}
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex-shrink-0 bg-blue-500/20 backdrop-blur-sm rounded-lg px-3 py-2 border border-blue-400/30">
                                <div class="text-center">
                                    <div class="text-2xl font-black text-blue-300">{{ $evento->fecha_inicio->format('d') }}</div>
                                    <div class="text-xs font-bold text-blue-400 uppercase">{{ $evento->fecha_inicio->format('M') }}</div>
                                </div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 text-sm text-blue-300 font-semibold mb-1">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $evento->fecha_inicio->format('H:i') }}</span>
                                </div>
                                @if($evento->lugar)
                                    <div class="flex items-center gap-2 text-xs text-white/60">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="truncate">{{ \Illuminate\Support\Str::limit($evento->lugar, 30) }}</span>
                                    </div>
                                @endif
                            </div>

                            <svg class="w-5 h-5 text-blue-300 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-3 leading-tight line-clamp-2">
                            {{ $evento->titulo }}
                        </h3>

                        @if($evento->descripcion)
                            <p class="text-white/70 text-sm leading-relaxed line-clamp-2">
                                {{ \Illuminate\Support\Str::limit($evento->descripcion, 100) }}
                            </p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Mensaje si no hay eventos --}}
        @if($eventosDestacados->count() === 0)
        <div class="text-center py-12">
            <svg class="w-20 h-20 text-white/60 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-white/80 text-lg font-medium">No hay eventos destacados en este momento</p>
        </div>
        @endif

        {{-- Botón ver todos (móvil) --}}
        <div class="text-center mt-10 lg:hidden">
            <a href="{{ route('eventos.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-blue-600 rounded-xl hover:bg-white/90 transition-all font-bold shadow-lg hover:shadow-xl backdrop-blur-sm border border-white/80">
                Ver todos los eventos
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════════
     SECCIÓN GALERÍA DE FOTOS
══════════════════════════════════════════════════════════════ --}}
@if($galeriaImagenes->count() > 0)
<section class="reveal relative z-10 overflow-hidden py-10" style="background: linear-gradient(160deg, rgba(15,23,42,0.88) 0%, rgba(30,41,59,0.85) 50%, rgba(15,23,42,0.90) 100%); backdrop-filter: blur(8px);">
    {{-- Decoración estrellas / partículas --}}
    <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="absolute top-10 right-20 w-72 h-72 bg-blue-600 rounded-full opacity-10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-56 h-56 bg-blue-700 rounded-full opacity-15 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-white mb-2">Momentos Destacados</h2>
            <p class="text-white/70 text-lg">Actividades y eventos del Vicerrectorado Académico</p>
        </div>

        {{-- Carrusel con 3 imágenes --}}
        <div x-data="{
            currentIndex: 0,
            itemsPerView: 3,
            totalItems: {{ $galeriaImagenes->count() }},
            autoplay: null,
            get maxIndex() {
                return Math.max(0, this.totalItems - this.itemsPerView);
            },
            init() {
                this.startAutoplay();
                window.addEventListener('resize', () => {
                    if (window.innerWidth < 768) {
                        this.itemsPerView = 1;
                    } else if (window.innerWidth < 1024) {
                        this.itemsPerView = 2;
                    } else {
                        this.itemsPerView = 3;
                    }
                });
            },
            startAutoplay() {
                this.autoplay = setInterval(() => {
                    this.next();
                }, 4000);
            },
            stopAutoplay() {
                clearInterval(this.autoplay);
            },
            next() {
                if (this.currentIndex < this.maxIndex) {
                    this.currentIndex++;
                } else {
                    this.currentIndex = 0;
                }
            },
            prev() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                } else {
                    this.currentIndex = this.maxIndex;
                }
            }
        }" class="relative">
            {{-- Contenedor del carrusel --}}
            <div class="overflow-hidden rounded-2xl">
                <div class="flex transition-transform duration-700 ease-in-out"
                     :style="`transform: translateX(-${currentIndex * (100 / itemsPerView)}%)`">
                    @foreach($galeriaImagenes as $index => $imagen)
                        <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-2">
                            <div class="group relative h-[400px] rounded-xl overflow-hidden bg-white/5 backdrop-blur border border-white/10 hover:border-white/30 transition-all">
                                <img src="{{ $imagen->url_imagen }}" 
                                     alt="{{ $imagen->titulo }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent group-hover:from-black/95 transition-all"></div>
                                
                                {{-- Información de la imagen --}}
                                <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                    <div class="mb-2">
                                        <span class="inline-block px-3 py-1 bg-blue-500/80 text-white text-xs font-bold rounded-full backdrop-blur-sm">
                                            Foto {{ $index + 1 }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-white mb-2 line-clamp-2">{{ $imagen->titulo }}</h3>
                                    @if($imagen->descripcion)
                                        <p class="text-white/80 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            {{ $imagen->descripcion }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Overlay decorativo --}}
                                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="bg-white/10 backdrop-blur-sm rounded-full p-2">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Botones de navegación --}}
            <button @click="prev(); stopAutoplay(); startAutoplay();" 
                    x-show="totalItems > itemsPerView"
                    class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white/90 hover:bg-white text-gray-800 p-4 rounded-full transition-all shadow-xl hover:shadow-2xl z-20 backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="next(); stopAutoplay(); startAutoplay();" 
                    x-show="totalItems > itemsPerView"
                    class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white/90 hover:bg-white text-gray-800 p-4 rounded-full transition-all shadow-xl hover:shadow-2xl z-20 backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Indicadores de progreso --}}
            <div class="flex justify-center gap-2 mt-8" x-show="totalItems > itemsPerView">
                <template x-for="i in (maxIndex + 1)" :key="i">
                    <button @click="currentIndex = i - 1; stopAutoplay(); startAutoplay();"
                            :class="currentIndex === i - 1 ? 'bg-blue-500 w-10' : 'bg-white/30 hover:bg-white/50 w-3'"
                            class="h-3 rounded-full transition-all duration-300"></button>
                </template>
            </div>

            {{-- Contador --}}
            <div class="text-center mt-4">
                <span class="text-white/60 text-sm font-medium" x-text="`${currentIndex + 1} - ${Math.min(currentIndex + itemsPerView, totalItems)} de ${totalItems} fotos`"></span>
            </div>
        </div>
    </div>
</section>
@endif

</x-public-layout>

<script>
(function () {
    // ── Blur del banner al hacer scroll ─────────────────────────────
    const bg     = document.getElementById('banner-bg');
    const banner = document.getElementById('hero-banner');

    if (bg && banner) {
        function onBannerScroll() {
            const ratio = Math.min(window.scrollY / (banner.offsetHeight * 0.8), 1);
            bg.style.filter = 'blur(' + (ratio * 16) + 'px)';
        }
        window.addEventListener('scroll', onBannerScroll, { passive: true });
        onBannerScroll();
    }

    // ── Animación del dot de scroll (bounce) ────────────────────────
    const dot = document.getElementById('scroll-dot');
    if (dot) {
        let pos = 0, dir = 1;
        setInterval(() => {
            pos += dir * 0.8;
            if (pos >= 14 || pos <= 0) dir *= -1;
            dot.style.marginTop = pos + 'px';
        }, 16);
    }

    // ── Animación fade-in + slide-up al entrar en viewport ──────────
    const style = document.createElement('style');
    style.textContent = `
        .reveal       { opacity: 0; transform: translateY(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-item  { opacity: 0; transform: translateY(24px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .reveal-item.visible { opacity: 1; transform: translateY(0); }
    `;
    document.head.appendChild(style);

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });

    document.querySelectorAll('.reveal, .reveal-item').forEach((el, i) => {
        // Escalonar los items dentro de una sección
        if (el.classList.contains('reveal-item')) {
            el.style.transitionDelay = (i % 6) * 0.1 + 's';
        }
        observer.observe(el);
    });
}());
</script>