<x-public-layout><div class="relative overflow-hidden min-h-screen" style="background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(30,41,59,0.92) 60%, rgba(30,58,138,0.90) 100%);"><div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full" style="background: radial-gradient(ellipse at 90% 20%, rgba(59,130,246,0.15) 0%, transparent 65%);"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96" style="background: radial-gradient(ellipse at 10% 90%, rgba(99,102,241,0.12) 0%, transparent 60%);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20"><div class="mb-16 text-center">
            
            <h1 class="text-5xl md:text-6xl font-black text-white leading-tight mb-6" style="letter-spacing: -1px;">
                Autoridades Académicas
            </h1>
            <p class="text-lg text-blue-100/80 leading-relaxed max-w-2xl mx-auto">Equipo de gestión comprometido con la excelencia académica y el desarrollo institucional</p>
        </div>@if($autoridades->isEmpty())
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-slate-800/50 backdrop-blur-sm mb-6 border border-slate-700/50">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-white/60 text-base font-medium">No hay autoridades registradas en este momento.</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($autoridades as $a)
                    <article class="group relative rounded-2xl overflow-hidden transition-all duration-300" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(16px);"><div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(ellipse at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 75%);"></div>
                        
                        <div class="relative px-7 py-8"><div class="mb-6 px-4">
                                <div class="relative flex items-center justify-between py-4 px-5 rounded-2xl transition-all duration-300 group/cargo" style="background: linear-gradient(135deg, rgba(6,182,212,0.35) 0%, rgba(59,130,246,0.35) 50%, rgba(99,102,241,0.30) 100%); border: 2px solid rgba(6,182,212,0.5); box-shadow: 0 8px 25px rgba(6,182,212,0.4);"><div class="relative flex-shrink-0">
                                        <div class="absolute inset-0 bg-cyan-400 rounded-lg blur-sm opacity-60 group-hover/cargo:opacity-100 transition-opacity"></div>
                                        <svg class="relative w-6 h-6 text-cyan-200 group-hover/cargo:text-cyan-100 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                        </svg>
                                    </div>
                                    
                                    <span class="text-white text-sm font-black uppercase tracking-wider drop-shadow-lg text-center">
                                        {{ $a->cargo }}
                                    </span><div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-transparent via-cyan-300/20 to-transparent opacity-0 group-hover/cargo:opacity-100 group-hover/cargo:animate-pulse transition-opacity"></div>
                                </div>
                            </div><div class="flex justify-center mb-6">
                                <div class="relative">
                                    @if($a->foto)
                                        <div class="relative w-48 h-48 rounded-full overflow-hidden" style="border: 3px solid rgba(59,130,246,0.3); box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                                            <img src="{{ asset('storage/' . $a->foto) }}"
                                                 alt="{{ $a->nombre }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        @php
                                            $nombreLower = strtolower($a->nombre);
                                            $esMujer = str_contains($nombreLower, 'dra.') || str_contains($nombreLower, 'mg.') || 
                                                       str_contains($nombreLower, 'lic.') || 
                                                       preg_match('/(ana|maria|rosa|carmen|julia|martha|patricia|gloria|teresa|beatriz|angela|laura|sandra|diana|elena|silvia)/', $nombreLower);
                                            $imagenDefault = $esMujer ? 'usuario-femenino.jpg' : 'usuario-masculino.jpg';
                                        @endphp
                                        <div class="relative w-48 h-48 rounded-full overflow-hidden" style="border: 3px solid rgba(59,130,246,0.3); box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                                            <img src="{{ asset('images/institucional/' . $imagenDefault) }}"
                                                 alt="{{ $a->nombre }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                </div>
                            </div><div class="text-center"><div class="flex items-center justify-center gap-2 mb-4">
                                    <h2 class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white via-blue-200 to-white leading-tight uppercase tracking-tight drop-shadow-lg">
                                        {{ $a->nombre }}
                                    </h2><div class="relative flex-shrink-0" title="Autoridad Verificada">
                                        <div class="absolute inset-0 bg-blue-500 rounded-full blur-md opacity-60"></div>
                                        <div class="relative w-6 h-6 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center border-2 border-white/30 shadow-lg">
                                            <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>@if($a->descripcion)
                                    <div class="px-4">
                                        <p class="text-white/70 text-sm leading-relaxed">
                                            {{ $a->descripcion }}
                                        </p>
                                    </div>
                                @endif
                            </div><div class="flex items-center justify-center gap-3 mb-5">
                                    <div class="relative inline-flex items-center gap-2 px-5 py-2.5 rounded-xl" style="background: linear-gradient(135deg, rgba(59,130,246,0.2) 0%, rgba(147,197,253,0.15) 100%); border: 1.5px solid rgba(59,130,246,0.4); box-shadow: 0 4px 15px rgba(59,130,246,0.2);"><svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-white font-bold text-sm tracking-wide">Período 2026-2030</span><svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg><div class="absolute inset-0 rounded-xl bg-gradient-to-r from-transparent via-white/10 to-transparent opacity-50"></div>
                                    </div>
                                </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

    </div>
</div>

</x-public-layout>