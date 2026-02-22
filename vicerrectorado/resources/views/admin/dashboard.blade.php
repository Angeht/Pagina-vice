@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-8 text-gray-800">
    Dashboard - Vicerrectorado Académico
</h1>

{{-- Tarjetas de Estadísticas --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    {{-- Noticias --}}
    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Noticias Publicadas</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['noticias_publicadas'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Total: {{ $stats['noticias_total'] }}</p>
            </div>
            <div class="text-blue-500">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('admin.noticias') }}" class="text-blue-600 text-sm font-medium mt-4 inline-block hover:underline">
            Ver todas →
        </a>
    </div>

    {{-- Convocatorias --}}
    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Convocatorias Abiertas</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['convocatorias_abiertas'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Total: {{ $stats['convocatorias_total'] }}</p>
            </div>
            <div class="text-green-500">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('admin.convocatorias') }}" class="text-green-600 text-sm font-medium mt-4 inline-block hover:underline">
            Gestionar →
        </a>
    </div>

    {{-- Documentos --}}
    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Documentos Activos</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['documentos_activos'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Gestión Académica</p>
            </div>
            <div class="text-purple-500">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('admin.gestion') }}" class="text-purple-600 text-sm font-medium mt-4 inline-block hover:underline">
            Ver documentos →
        </a>
    </div>

    {{-- Autoridades --}}
    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Autoridades</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['autoridades_activas'] }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $stats['unidades_activas'] }} Unidades</p>
            </div>
            <div class="text-orange-500">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('admin.autoridades') }}" class="text-orange-600 text-sm font-medium mt-4 inline-block hover:underline">
            Gestionar →
        </a>
    </div>

</div>

{{-- Sección de Actividad Reciente --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    
    {{-- Noticias Recientes --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Últimas Noticias</h2>
        
        @if($noticiasRecientes->count())
            <div class="space-y-3">
                @foreach($noticiasRecientes as $noticia)
                    <div class="flex items-start p-3 hover:bg-gray-50 rounded transition">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ Str::limit($noticia->titulo, 50) }}</p>
                            <div class="flex items-center text-xs text-gray-500 mt-1 space-x-3">
                                <span>{{ $noticia->created_at->diffForHumans() }}</span>
                                @if($noticia->categoria)
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded">{{ $noticia->categoria->nombre }}</span>
                                @endif
                                @if($noticia->publicado)
                                    <span class="text-green-600 font-medium">✓ Publicado</span>
                                @else
                                    <span class="text-gray-500">• Borrador</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.noticias') }}" class="block text-center text-blue-600 font-medium mt-4 hover:underline">
                Ver todas las noticias
            </a>
        @else
            <p class="text-gray-500 text-center py-8">No hay noticias registradas</p>
        @endif
    </div>

    {{-- Convocatorias Próximas/Abiertas --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Convocatorias Activas</h2>
        
        @if($convocatoriasProximas->count())
            <div class="space-y-3">
                @foreach($convocatoriasProximas as $conv)
                    <div class="flex items-start p-3 hover:bg-gray-50 rounded transition">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ Str::limit($conv->titulo, 50) }}</p>
                            <div class="flex items-center text-xs text-gray-500 mt-1 space-x-3">
                                <span>Cierre: {{ $conv->fecha_cierre->format('d/m/Y') }}</span>
                                <span class="px-2 py-0.5 bg-gray-100 rounded capitalize">{{ $conv->tipo }}</span>
                                @if($conv->estado === 'abierta')
                                    <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded font-medium">Abierta</span>
                                @else
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded font-medium">Próxima</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.convocatorias') }}" class="block text-center text-green-600 font-medium mt-4 hover:underline">
                Ver todas las convocatorias
            </a>
        @else
            <p class="text-gray-500 text-center py-8">No hay convocatorias activas</p>
        @endif
    </div>

</div>

{{-- Accesos Rápidos --}}
<div class="bg-white shadow rounded-lg p-6 mt-6">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Accesos Rápidos</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.noticias') }}" class="p-4 border rounded-lg hover:bg-blue-50 hover:border-blue-300 transition text-center">
            <p class="font-medium text-gray-700">📰 Noticias</p>
        </a>
        <a href="{{ route('admin.convocatorias') }}" class="p-4 border rounded-lg hover:bg-green-50 hover:border-green-300 transition text-center">
            <p class="font-medium text-gray-700">📢 Convocatorias</p>
        </a>
        <a href="{{ route('admin.categorias') }}" class="p-4 border rounded-lg hover:bg-purple-50 hover:border-purple-300 transition text-center">
            <p class="font-medium text-gray-700">🏷️ Categorías</p>
        </a>
        <a href="{{ route('admin.banner') }}" class="p-4 border rounded-lg hover:bg-orange-50 hover:border-orange-300 transition text-center">
            <p class="font-medium text-gray-700">🎨 Banner</p>
        </a>
    </div>
</div>

@endsection
