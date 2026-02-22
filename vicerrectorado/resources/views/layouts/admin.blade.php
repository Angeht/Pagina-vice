<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 text-white flex flex-col">
        <div class="p-6 text-lg font-bold border-b border-slate-700">
            Vicerrectorado
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                Dashboard
            </a>
            <a href="{{ route('admin.banner') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700">
                    Configuración Banner
            </a>
            <a href="{{ route('admin.autoridades') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700">
                    Autoridades
            </a>
            <a href="{{ route('admin.noticias') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700">
                Noticias
            </a>
            <a href="#"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                Documentos
            </a>
            <a href="{{ route('admin.categorias') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700">
                    Categorías
            </a>
            <a href="{{ route('admin.unidades') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700">
                    Unidades
            </a>
            <a href="{{ route('admin.gestion') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700">
                    Gestión Académica
            </a>
            <a href="{{ route('admin.convocatorias') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700">
                    Convocatorias
            </a>
            <a href="{{ route('admin.logs') }}"
                class="block px-4 py-2 rounded hover:bg-slate-700 border-t border-slate-700 mt-2 pt-4">
                    📋 Logs de Auditoría
            </a>
        </nav>
        <div class="p-4 border-t border-slate-700 text-sm space-y-2">

            <div class="font-semibold">
                {{ auth()->user()->name }}
            </div>

            <a href="{{ route('profile.edit') }}"
            class="block text-slate-300 hover:text-white">
                Editar Perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="text-slate-300 hover:text-red-400 w-full text-left">
                    Cerrar Sesión
                </button>
            </form>

        </div>

        
    </aside>

    <!-- Content -->
    <main class="flex-1 p-8">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot }}
        @endif
    </main>

</div>

@livewireScripts
</body>
</html>
