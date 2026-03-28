<x-public-layout>

<div class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 60%, rgba(30,58,138,0.90) 100%);">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 90% 20%, rgba(59,130,246,0.15) 0%, transparent 65%);"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96" style="background: radial-gradient(ellipse at 10% 90%, rgba(99,102,241,0.12) 0%, transparent 60%);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        <div class="mb-16 text-center">

            <h1 class="text-5xl md:text-6xl font-black text-white leading-tight mb-6" style="letter-spacing: -1px;">
                Estructura Académica
            </h1>
            <p class="text-lg text-blue-100/80 leading-relaxed max-w-2xl mx-auto">Conoce la organización y unidades que conforman el Vicerrectorado Académico</p>
        </div>

        <div class="mb-5">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-blue-600 rounded-full"></div>
                <h2 class="text-3xl font-black text-white">
                    Direcciones
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($direcciones as $u)
                    <a href="{{ route('estructura.show', $u) }}"
                       class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);"><div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 75%);"></div>

                        @if($u->imagen)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $u->imagen) }}"
                                     alt="{{ $u->nombre }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div><div class="absolute top-4 left-4 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <div class="relative p-6">
                            @if(!$u->imagen)<div class="mb-4 flex items-center justify-between">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-blue-300 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            @else
                                <div class="mb-4 flex justify-end">
                                    <svg class="w-5 h-5 text-blue-300 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-white mb-3 leading-tight">
                                {{ $u->nombre }}
                            </h3>

                            <p class="text-white/70 text-sm leading-relaxed">
                                {{ \Illuminate\Support\Str::limit($u->descripcion, 100) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1 h-8 bg-gradient-to-b from-indigo-400 to-indigo-600 rounded-full"></div>
                <h2 class="text-3xl font-black text-white">
                    Unidades de Apoyo
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($unidades as $u)
                    <a href="{{ route('estructura.show', $u) }}"
                       class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);">

                        <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(99,102,241,0.12) 0%, transparent 75%);"></div>

                        @if($u->imagen)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $u->imagen) }}"
                                     alt="{{ $u->nombre }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                                <div class="absolute top-4 left-4 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <div class="relative p-6">
                            @if(!$u->imagen)
                                <div class="mb-4 flex items-center justify-between">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-indigo-300 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            @else
                                <div class="mb-4 flex justify-end">
                                    <svg class="w-5 h-5 text-indigo-300 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-white mb-3 leading-tight">
                                {{ $u->nombre }}
                            </h3>

                            <p class="text-white/70 text-sm leading-relaxed">
                                {{ \Illuminate\Support\Str::limit($u->descripcion, 100) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>

</x-public-layout>
