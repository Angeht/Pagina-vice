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
                Eventos Académicos
            </h1>
            <p class="text-lg text-blue-100/80 leading-relaxed max-w-2xl mx-auto">
                Actividades académicas, culturales e institucionales del Vicerrectorado Académico UNASAM
            </p>
        </div>

        {{-- EVENTOS DESTACADOS --}}
        @if($destacados->count())
            <div class="mb-16">
                {{-- Header de sección --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-purple-400 to-purple-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Eventos Destacados
                    </h2>
                    <span class="px-3 py-1 bg-purple-500/20 text-purple-300 text-sm font-bold rounded-lg border border-purple-500/30">
                        {{ $destacados->count() }} {{ $destacados->count() === 1 ? 'evento' : 'eventos' }}
                    </span>
                </div>

                {{-- Grid de eventos --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($destacados as $evento)
                        @include('public.eventos._card', ['evento' => $evento])
                    @endforeach
                </div>
            </div>
        @endif

        {{-- PRÓXIMOS EVENTOS --}}
        @if($proximos->count())
            <div class="mb-16">
                {{-- Header de sección --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-blue-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Próximos Eventos
                    </h2>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-300 text-sm font-bold rounded-lg border border-blue-500/30">
                        {{ $proximos->count() }} {{ $proximos->count() === 1 ? 'evento' : 'eventos' }}
                    </span>
                </div>

                {{-- Grid de eventos --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($proximos as $evento)
                        @include('public.eventos._card', ['evento' => $evento])
                    @endforeach
                </div>
            </div>
        @endif

        {{-- EN CURSO --}}
        @if($enCurso->count())
            <div class="mb-16">
                {{-- Header de sección --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-green-400 to-green-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        En Curso Ahora
                    </h2>
                    <span class="px-3 py-1 bg-green-500/20 text-green-300 text-sm font-bold rounded-lg border border-green-500/30">
                        {{ $enCurso->count() }} {{ $enCurso->count() === 1 ? 'evento' : 'eventos' }}
                    </span>
                </div>

                {{-- Grid de eventos --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($enCurso as $evento)
                        @include('public.eventos._card', ['evento' => $evento])
                    @endforeach
                </div>
            </div>
        @endif

        {{-- EVENTOS PASADOS --}}
        @if($pasados->count())
            <div class="mb-16">
                {{-- Header de sección --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1 h-8 bg-gradient-to-b from-gray-400 to-gray-600 rounded-full"></div>
                    <h2 class="text-3xl font-black text-white">
                        Eventos Pasados
                    </h2>
                    <span class="px-3 py-1 bg-gray-500/20 text-gray-300 text-sm font-bold rounded-lg border border-gray-500/30">
                        {{ $pasados->total() }} {{ $pasados->total() === 1 ? 'evento' : 'eventos' }}
                    </span>
                </div>

                {{-- Grid de eventos --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($pasados as $evento)
                        @include('public.eventos._card', ['evento' => $evento])
                    @endforeach
                </div>

                {{-- Paginación --}}
                <div class="mt-8">
                    {{ $pasados->links() }}
                </div>
            </div>
        @endif

        {{-- Mensaje si no hay eventos --}}
        @if($destacados->isEmpty() && $proximos->isEmpty() && $enCurso->isEmpty() && $pasados->isEmpty())
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-2xl mb-6" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px); border: 2px solid rgba(255,255,255,0.15);">
                    <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-white mb-3">No hay eventos disponibles</h3>
                <p class="text-white/70 text-base max-w-md mx-auto">
                    Los eventos estarán disponibles próximamente. Vuelve a consultar más tarde.
                </p>
            </div>
        @endif

    </div>
</div>

</x-public-layout>
