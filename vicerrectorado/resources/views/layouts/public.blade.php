<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navegación Pública -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-gray-900">
                        Vicerrectorado Académico
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-700 hover:text-gray-900">Inicio</a>
                    <a href="{{ route('noticias.index') }}" class="text-gray-700 hover:text-gray-900">Noticias</a>
                    <a href="{{ route('autoridades.index') }}" class="text-gray-700 hover:text-gray-900">Autoridades</a>
                    <a href="{{ route('estructura.index') }}" class="text-gray-700 hover:text-gray-900">Estructura Organizativa</a>
                    <a href="{{ route('gestion.index') }}" class="text-gray-700 hover:text-gray-900">Gestión Académica</a>
                    <a href="{{ route('convocatorias.index') }}" class="text-gray-700 hover:text-gray-900">Convocatorias</a>
                <form action="{{ route('buscar') }}" method="GET" class="flex">
                    <input type="text" name="q"
                        placeholder="Buscar..."
                        class="border rounded-l px-3 py-1 text-sm">
                    <button class="bg-blue-600 text-white px-3 rounded-r">
                        🔎
                    </button>
                </form>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Iniciar Sesión</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} Vicerrectorado Académico. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
