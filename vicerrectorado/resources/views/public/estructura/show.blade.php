<x-public-layout>

<div class="relative min-h-screen py-16" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);"><div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-20 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto"><div class="mb-8">
                <a href="{{ route('estructura.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-white/70 hover:text-white transition-colors"
                   style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="font-medium">Volver a Estructura</span>
                </a>
            </div><h1 class="text-4xl md:text-5xl font-bold text-white mb-8 leading-tight">
                {{ $unidad->nombre }}
            </h1><div class="grid lg:grid-cols-2 gap-8 mb-8"><div class="space-y-6">@if($unidad->responsable)
                        <div class="rounded-2xl overflow-hidden" style="background: rgba(59,130,246,0.1); backdrop-filter: blur(16px); border: 1px solid rgba(59,130,246,0.2);">
                            <div class="p-6">
                                <div class="flex gap-3">
                                    <svg class="w-6 h-6 text-blue-300 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <div>
                                        <h3 class="text-blue-300 font-semibold text-sm mb-1">Responsable</h3>
                                        <p class="text-white font-bold text-lg">
                                            {{ $unidad->responsable }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif@if($unidad->descripcion)
                        <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                            <div class="p-6">
                                <div class="flex gap-3">
                                    <svg class="w-6 h-6 text-white/70 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <h3 class="text-white font-bold text-lg mb-3">Descripción</h3>
                                        <p class="text-white/90 leading-relaxed">
                                            {{ $unidad->descripcion }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif@if($unidad->correo || $unidad->telefono)
                        <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">
                            <div class="p-6">
                                <h3 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Contacto
                                </h3>
                                <div class="space-y-3">
                                    @if($unidad->correo)
                                        <div class="flex items-center gap-3 text-white/80">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(59,130,246,0.15);">
                                                <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-white/60 font-medium">Correo electrónico</p>
                                                <a href="mailto:{{ $unidad->correo }}" class="text-blue-300 hover:text-blue-200 transition-colors font-medium">
                                                    {{ $unidad->correo }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    @if($unidad->telefono)
                                        <div class="flex items-center gap-3 text-white/80">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(34,197,94,0.15);">
                                                <svg class="w-5 h-5 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-white/60 font-medium">Teléfono</p>
                                                <a href="tel:{{ $unidad->telefono }}" class="text-green-300 hover:text-green-200 transition-colors font-medium">
                                                    {{ $unidad->telefono }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                </div><div class="rounded-2xl overflow-hidden shadow-2xl h-fit">
                    @if($unidad->imagen)
                        <img src="{{ asset('storage/' . $unidad->imagen) }}"
                             alt="{{ $unidad->nombre }}"
                             class="w-full h-full object-cover min-h-[400px] max-h-[600px]">
                    @else
                        <div class="w-full min-h-[400px] max-h-[600px] flex items-center justify-center relative overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);">
                            <img src="{{ asset('images/institucional/fondo ciudad universitaria.png') }}"
                                 alt="UNASAM"
                                 class="absolute inset-0 w-full h-full object-cover opacity-10">
                            <div class="relative z-10 text-center text-white p-8">
                                <svg class="w-32 h-32 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <p class="text-2xl font-bold">{{ $unidad->nombre }}</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</div>

</x-public-layout>