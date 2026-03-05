<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - UNASAM</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/institucional/favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ mobileMenuOpen: false }">
    <!-- Navegación Principal -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo y Título -->
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <a href="/" class="flex items-center">
                            <img src="{{ asset('images/institucional/logo-unasam.png') }}" 
                                 alt="Logo UNASAM" 
                                 class="h-10 w-auto">
                        </a>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-gray-900">Vicerrectorado Académico</span>
                        <span class="text-xs text-gray-600">UNASAM</span>
                    </div>
                </div>
                
                <!-- Menú Desktop -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="/" class="px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Inicio
                    </a>
                    <a href="{{ route('noticias.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Noticias
                    </a>
                    <a href="{{ route('autoridades.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Autoridades
                    </a>
                    <a href="{{ route('estructura.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Estructura
                    </a>
                    <a href="{{ route('gestion.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Gestión Académica
                    </a>
                    <a href="{{ route('convocatorias.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Convocatorias
                    </a>
                    <a href="{{ route('eventos.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        Eventos
                    </a>
                </div>

                <!-- Acciones Desktop -->
                <div class="flex items-center space-x-2">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-block px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-block px-4 py-2 text-sm text-gray-700 hover:text-blue-600 border border-gray-300 rounded-lg hover:border-blue-600 transition-colors">
                            Iniciar Sesión
                        </a>
                    @endauth

                    <!-- Botón Menú Móvil -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Menú Móvil -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="lg:hidden border-t border-gray-200 bg-white">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                        Inicio
                    </a>
                    <a href="{{ route('noticias.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                        Noticias
                    </a>
                    <a href="{{ route('autoridades.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                        Autoridades
                    </a>
                    <a href="{{ route('estructura.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                        Estructura
                    </a>
                    <a href="{{ route('gestion.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                        Gestión Académica
                    </a>
                    <a href="{{ route('convocatorias.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                        Convocatorias
                    </a>
                    <a href="{{ route('eventos.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                        Eventos
                    </a>

                    <!-- Botones de Acción Móvil -->
                    <div class="pt-3 border-t border-gray-200 space-y-2">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-center bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-center text-gray-700 border border-gray-300 rounded-lg hover:border-blue-600">
                                Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="min-h-screen">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>

    <!-- Footer Institucional -->
    <footer class="relative z-10 bg-gradient-to-r from-gray-800 via-gray-800 to-gray-900 text-white mt-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Columna 1: Información -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/institucional/logo-unasam.png') }}" 
                             alt="Logo UNASAM" 
                             class="h-12 w-auto">
                        <div>
                            <h3 class="text-xl font-bold">Vicerrectorado Académico</h3>
                            <p class="text-gray-300 text-sm">UNASAM</p>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm mb-4">
                        Universidad Nacional Santiago Antúnez de Mayolo
                    </p>
                    <p class="text-gray-400 text-sm">
                        Comprometidos con la excelencia académica y la formación integral de nuestros estudiantes.
                    </p>
                </div>

                <!-- Columna 2: Enlaces Rápidos -->
                <div>
                    <h4 class="font-semibold mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('noticias.index') }}" class="hover:text-blue-400 transition-colors">Noticias</a></li>
                        <li><a href="{{ route('autoridades.index') }}" class="hover:text-blue-400 transition-colors">Autoridades</a></li>
                        <li><a href="{{ route('convocatorias.index') }}" class="hover:text-blue-400 transition-colors">Convocatorias</a></li>
                        <li><a href="{{ route('gestion.index') }}" class="hover:text-blue-400 transition-colors">Gestión Académica</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Contacto -->
                <div>
                    <h4 class="font-semibold mb-4">Contacto</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Av. Centenario 200, Huaraz - Ancash</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>vicerrectorado@unasam.edu.pe</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>(043) 424-066</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Universidad Nacional Santiago Antúnez de Mayolo - Vicerrectorado Académico. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
