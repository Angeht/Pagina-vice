<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada | UNASAM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/institucional/favicon.png') }}">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-4xl w-full">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="grid md:grid-cols-2 gap-0">
                    <!-- Imagen -->
                    <div class="relative h-64 md:h-auto">
                        <img src="{{ asset('images/imagenes/404.jpg') }}" 
                             alt="404 No encontrado" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 to-transparent"></div>
                    </div>

                    <!-- Contenido -->
                    <div class="p-8 md:p-12 flex flex-col justify-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/institucional/logo-unasam.png') }}" 
                                 alt="Logo UNASAM" 
                                 class="h-16 w-auto mb-4">
                        </div>

                        <h1 class="text-6xl font-bold text-blue-900 mb-4">404</h1>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                            Página no encontrada
                        </h2>
                        <p class="text-gray-600 mb-8">
                            Lo sentimos, la página que buscas no existe o ha sido movida. 
                            Verifica la URL o regresa al inicio.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="/" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Ir al Inicio
                            </a>
                            <button onclick="history.back()" 
                                    class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver Atrás
                            </button>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-500">
                                Vicerrectorado Académico - UNASAM
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
