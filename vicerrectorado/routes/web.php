<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SystemController;
use App\Livewire\Admin\Noticias\Index as NoticiasIndex;
use App\Models\Noticia;
use App\Livewire\Admin\Categorias\Index as CategoriasIndex;
use App\Livewire\Admin\Configuracion\Banner;
use App\Livewire\Admin\Configuracion\Vicerrector as VicerrectorConfig;
use App\Livewire\Admin\Autoridades\Index as AutoridadesIndex;
use App\Models\Unidad;
use App\Livewire\Admin\Unidades\Index as UnidadesIndex;
use App\Livewire\Admin\DocumentosAcademicos\Index as DocumentosAcademicosIndex;
use App\Models\DocumentoAcademico;
use App\Livewire\Admin\Convocatorias\Index as ConvocatoriasIndex;
use App\Models\Convocatoria;
use App\Livewire\Admin\Logs\Index as LogsIndex;
use App\Livewire\Admin\Eventos\Index as EventosAdminIndex;
use App\Models\Evento;
use App\Livewire\Admin\Usuarios\Index as UsuariosIndex;
use App\Livewire\Admin\Galeria\Index as GaleriaIndex;
use App\Models\GaleriaImagen;

// Ruta dashboard que Breeze necesita
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Zona pública
Route::get('/buscar', function (Request $request) {

    $q = $request->q;

    $noticias = Noticia::where('publicado', true)
        ->where('titulo', 'like', "%$q%")
        ->get();

    $convocatorias = Convocatoria::where('activo', true)
        ->where('titulo', 'like', "%$q%")
        ->get();

    $documentos = DocumentoAcademico::where('activo', true)
        ->where('titulo', 'like', "%$q%")
        ->get();

    return view('public.buscar', compact(
        'q',
        'noticias',
        'convocatorias',
        'documentos'
    ));

})->name('buscar');
Route::get('/convocatorias', function () {

    $convocatorias = Convocatoria::where('activo', true)
        ->orderByDesc('fecha_inicio')
        ->get();

    $abiertas = $convocatorias->filter(fn($c) => $c->estado === 'abierta');
    $proximas = $convocatorias->filter(fn($c) => $c->estado === 'proxima');
    $cerradas = $convocatorias->filter(fn($c) => $c->estado === 'cerrada');

    return view('public.convocatorias.index', compact(
        'abiertas',
        'proximas',
        'cerradas'
    ));

})->name('convocatorias.index');


Route::get('/convocatorias/{convocatoria:slug}', function (Convocatoria $convocatoria) {

    if (!$convocatoria->activo) {
        abort(404);
    }

    return view('public.convocatorias.show', compact('convocatoria'));

})->name('convocatorias.show');

Route::get('/gestion-academica', function () {

    $documentos = DocumentoAcademico::where('activo', true)
        ->orderBy('tipo')
        ->orderByDesc('fecha_publicacion')
        ->get()
        ->groupBy('tipo');

    return view('public.gestion.index', compact('documentos'));

})->name('gestion.index');


Route::get('/autoridades', function () {
    $autoridades = \App\Models\Autoridad::where('activo', true)
                    ->orderBy('orden')
                    ->get();

    return view('public.autoridades', compact('autoridades'));
})->name('autoridades.index');


Route::get('/estructura', function () {

    $direcciones = Unidad::where('activo', true)
                    ->where('tipo', 'direccion')
                    ->orderBy('orden')
                    ->get();

    $unidades = Unidad::where('activo', true)
                    ->where('tipo', 'unidad')
                    ->orderBy('orden')
                    ->get();

    return view('public.estructura.index', compact('direcciones', 'unidades'));

})->name('estructura.index');


Route::get('/estructura/{unidad:slug}', function (Unidad $unidad) {

    if (!$unidad->activo) {
        abort(404);
    }

    return view('public.estructura.show', compact('unidad'));

})->name('estructura.show');


Route::get('/', function () {

    $noticias = Noticia::where('publicado', true)
        ->latest()
        ->take(6)
        ->get();

    $convocatoriasAbiertas = Convocatoria::where('activo', true)
        ->get()
        ->filter(fn($c) => $c->estado === 'abierta')
        ->take(3);

    $documentoReciente = DocumentoAcademico::where('activo', true)
        ->latest()
        ->first();

    // Buscar al Vicerrector Académico
    $vicerrectorAcademico = \App\Models\Autoridad::where('activo', true)
        ->where(function($query) {
            $query->where('cargo', 'like', '%vicerrector%académico%')
                  ->orWhere('cargo', 'like', '%vicerrector%academico%');
        })
        ->orderBy('orden')
        ->first();

    // Si no encuentra por cargo, tomar el primero en orden
    if (!$vicerrectorAcademico) {
        $vicerrectorAcademico = \App\Models\Autoridad::where('activo', true)
            ->orderBy('orden')
            ->first();
    }

    // Eventos destacados - últimos 3 más importantes
    $eventosDestacados = \App\Models\Evento::where('activo', true)
        ->where('destacado', true)
        ->orderBy('destacado', 'desc')
        ->orderBy('fecha_inicio', 'desc')
        ->take(3)
        ->get();

    // Galería de imágenes para el carrusel
    $galeriaImagenes = GaleriaImagen::activas()->get();

    return view('public.home', compact(
        'noticias',
        'convocatoriasAbiertas',
        'documentoReciente',
        'vicerrectorAcademico',
        'eventosDestacados',
        'galeriaImagenes'
    ));

});

Route::get('/noticias', function () {

    $query = Noticia::where('publicado', true)->latest();

    if (request('categoria')) {
        $query->whereHas('categoria', function ($q) {
            $q->where('slug', request('categoria'));
        });
    }

    $noticias = $query->paginate(6);

    return view('public.noticias.index', compact('noticias'));
})->name('noticias.index');

Route::get('/noticias/{noticia:slug}', function (Noticia $noticia) {

    if (!$noticia->publicado) {
        abort(404);
    }

    return view('public.noticias.show', compact('noticia'));
})->name('noticias.show');


// Eventos públicos
Route::get('/eventos', function () {
    $todos = Evento::where('activo', true)->with('galeria')->latest('fecha_inicio')->get();

    $destacados = $todos->filter(fn($e) => $e->destacado)->values();
    $proximos   = $todos->filter(fn($e) => $e->estado === 'proximo' && !$e->destacado)->values();
    $enCurso    = $todos->filter(fn($e) => $e->estado === 'en_curso' && !$e->destacado)->values();
    $pasados    = Evento::where('activo', true)
                    ->with('galeria')
                    ->where(fn($q) => $q->where('fecha_fin', '<', now())->orWhereNull('fecha_fin'))
                    ->where('destacado', false)
                    ->latest('fecha_inicio')
                    ->paginate(8);

    return view('public.eventos.index', compact('destacados', 'proximos', 'enCurso', 'pasados'));
})->name('eventos.index');

Route::get('/eventos/{evento:slug}', function (Evento $evento) {
    if (!$evento->activo) abort(404);

    $evento->load('galeria');
    $otrosEventos = Evento::where('activo', true)
        ->where('id', '!=', $evento->id)
        ->with('galeria')
        ->latest('fecha_inicio')
        ->take(3)
        ->get();

    return view('public.eventos.show', compact('evento', 'otrosEventos'));
})->name('eventos.show');


// Grupo Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        // Endpoint con información del sistema
        Route::get('/system/info', [SystemController::class, 'info'])
        ->name('admin.system.info');

        Route::get('/dashboard', function () {
            $stats = [
                'noticias_total' => \App\Models\Noticia::count(),
                'noticias_publicadas' => \App\Models\Noticia::where('publicado', true)->count(),
                'convocatorias_abiertas' => \App\Models\Convocatoria::where('activo', true)
                    ->get()
                    ->filter(fn($c) => $c->estado === 'abierta')
                    ->count(),
                'convocatorias_total' => \App\Models\Convocatoria::count(),
                'documentos_activos' => \App\Models\DocumentoAcademico::where('activo', true)->count(),
                'autoridades_activas' => \App\Models\Autoridad::where('activo', true)->count(),
                'unidades_activas' => \App\Models\Unidad::where('activo', true)->count(),
                'categorias_total' => \App\Models\Categoria::count(),
            ];

            $noticiasRecientes = \App\Models\Noticia::latest()->take(5)->get();
            $convocatoriasProximas = \App\Models\Convocatoria::where('activo', true)
                ->orderBy('fecha_inicio')
                ->get()
                ->filter(fn($c) => in_array($c->estado, ['abierta', 'proxima']))
                ->take(5);

            return view('admin.dashboard', compact('stats', 'noticiasRecientes', 'convocatoriasProximas'));
        })->name('admin.dashboard');
        Route::get('/noticias', NoticiasIndex::class)
        ->name('admin.noticias');
        Route::get('/categorias', CategoriasIndex::class)
        ->name('admin.categorias');
        Route::get('/configuracion/banner', Banner::class)
        ->name('admin.banner');
        Route::get('/configuracion/vicerrector', VicerrectorConfig::class)
        ->name('admin.vicerrector');
        Route::get('/autoridades', AutoridadesIndex::class)
        ->name('admin.autoridades');
        Route::get('/unidades', UnidadesIndex::class)
        ->name('admin.unidades');
        Route::get('/gestion-academica', DocumentosAcademicosIndex::class)
        ->name('admin.gestion');
        Route::get('/convocatorias', ConvocatoriasIndex::class)
        ->name('admin.convocatorias');
        Route::get('/logs', LogsIndex::class)
        ->name('admin.logs');
        Route::get('/eventos', EventosAdminIndex::class)
        ->name('admin.eventos');
        Route::get('/usuarios', UsuariosIndex::class)
        ->name('admin.usuarios');
        Route::get('/galeria', GaleriaIndex::class)
        ->name('admin.galeria');
    });

require __DIR__.'/auth.php';
