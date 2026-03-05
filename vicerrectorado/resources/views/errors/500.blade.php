<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error del Servidor | UNASAM</title>
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
                        <img src="{{ asset('images/institucional/error 500.jpg') }}" 
                             alt="Error 500" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-red-900/80 to-transparent"></div>
                    </div>

                    <!-- Contenido -->
                    <div class="p-8 md:p-12 flex flex-col justify-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/institucional/logo-unasam.png') }}" 
                                 alt="Logo UNASAM" 
                                 class="h-16 w-auto mb-4">
                        </div>

                        <h1 class="text-6xl font-bold text-red-600 mb-4">500</h1>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                            Error del Servidor
                        </h2>
                        <p class="text-gray-600 mb-8">
                            Lo sentimos, algo salió mal en nuestro servidor. Nuestro equipo técnico 
                            ya ha sido notificado y está trabajando para resolver el problema.
                        </p>

                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                            <div class="flex">
                                <svg class="h-5 w-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-sm text-yellow-700">
                                    Si el problema persiste, por favor contacta con soporte técnico.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="/" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Ir al Inicio
                            </a>
                            <button onclick="location.reload()" 
                                    class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Intentar de Nuevo
                            </button>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-500">
                                Vicerrectorado Académico - UNASAM
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                Soporte: vicerrectorado@unasam.edu.pe
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
