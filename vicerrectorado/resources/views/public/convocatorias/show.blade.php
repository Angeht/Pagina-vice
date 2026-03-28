<x-public-layout><div class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 30%, rgba(30,58,138,0.90) 60%, rgba(15,23,42,0.93) 100%);"><div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 80% 30%, rgba(59,130,246,0.15) 0%, transparent 65%);"></div>
    </div><div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full opacity-15 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20"><a href="{{ route('convocatorias.index') }}" class="inline-flex items-center gap-2 text-blue-300 hover:text-blue-200 mb-8 transition-colors duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="font-semibold">Volver a convocatorias</span>
        </a><div class="mb-6">
            @php
                $now = now();
                $isOpen = $convocatoria->fecha_inicio <= $now && $convocatoria->fecha_cierre >= $now;
                $isPending = $convocatoria->fecha_inicio > $now;
                $isClosed = $convocatoria->fecha_cierre < $now;
            @endphp

            @if($isOpen)
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/20 text-green-300 text-sm font-bold rounded-lg border border-green-500/40">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Convocatoria Abierta
                </span>
            @elseif($isPending)
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500/20 text-indigo-300 text-sm font-bold rounded-lg border border-indigo-500/40">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Próximamente
                </span>
            @else
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/20 text-red-300 text-sm font-bold rounded-lg border border-red-500/40">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Convocatoria Cerrada
                </span>
            @endif
        </div><h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-8" style="letter-spacing: -1px;">
            {{ $convocatoria->titulo }}
        </h1><div class="rounded-2xl overflow-hidden mb-8" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
            <div class="p-8"><div class="grid md:grid-cols-2 gap-6 mb-8"><div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-lg flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white/60 text-sm font-semibold mb-1">Fecha de Inicio</p>
                            <p class="text-white text-xl font-bold">{{ $convocatoria->fecha_inicio->format('d/m/Y') }}</p>
                        </div>
                    </div><div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white/60 text-sm font-semibold mb-1">Fecha de Cierre</p>
                            <p class="text-white text-xl font-bold">{{ $convocatoria->fecha_cierre->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>@if($convocatoria->descripcion)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-white mb-4">Descripción</h2>
                        <div class="text-white/80 leading-relaxed text-base">
                            {!! nl2br(e($convocatoria->descripcion)) !!}
                        </div>
                    </div>
                @endif@if($convocatoria->archivo)
                    <div class="pt-6 border-t border-white/10">
                        <h2 class="text-xl font-bold text-white mb-4">Documentación</h2>
                        <a href="{{ asset('storage/' . $convocatoria->archivo) }}"
                           target="_blank"
                           class="inline-flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                            </svg>
                            <div class="text-left">
                                <p class="text-sm opacity-90">Descargar</p>
                                <p class="text-lg">Bases de la Convocatoria (PDF)</p>
                            </div>
                        </a>
                    </div>
                @endif

            </div>
        </div><div class="rounded-2xl overflow-hidden" style="background: rgba(59,130,246,0.1); backdrop-filter: blur(16px); border: 1px solid rgba(59,130,246,0.2);">
            <div class="p-6">
                <div class="flex gap-3">
                    <svg class="w-6 h-6 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h3 class="text-white font-bold mb-2">Información Importante</h3>
                        <p class="text-blue-100/80 text-sm leading-relaxed">
                            Asegúrate de revisar todos los requisitos y fechas importantes antes de postular. Para más información, contacta con el área correspondiente.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</x-public-layout>