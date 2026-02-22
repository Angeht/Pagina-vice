<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Livewire\Admin\Noticias\Index as NoticiasIndex;
use App\Models\Noticia;
use App\Livewire\Admin\Categorias\Index as CategoriasIndex;
use App\Livewire\Admin\Configuracion\Banner;
use App\Livewire\Admin\Autoridades\Index as AutoridadesIndex;
use App\Models\Unidad;
use App\Livewire\Admin\Unidades\Index as UnidadesIndex;
use App\Livewire\Admin\DocumentosAcademicos\Index as DocumentosAcademicosIndex;
use App\Models\DocumentoAcademico;
use App\Livewire\Admin\Convocatorias\Index as ConvocatoriasIndex;
use App\Models\Convocatoria;

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
        ->orderBy('orden')
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

    return view('public.home', compact(
        'noticias',
        'convocatoriasAbiertas',
        'documentoReciente'
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


// Grupo Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::get('/noticias', NoticiasIndex::class)
        ->name('admin.noticias');
        Route::get('/categorias', CategoriasIndex::class)
        ->name('admin.categorias');
        Route::get('/configuracion/banner', Banner::class)
        ->name('admin.banner');
        Route::get('/autoridades', AutoridadesIndex::class)
        ->name('admin.autoridades');
        Route::get('/unidades', UnidadesIndex::class)
        ->name('admin.unidades');
        Route::get('/gestion-academica', DocumentosAcademicosIndex::class)
        ->name('admin.gestion');
        Route::get('/convocatorias', ConvocatoriasIndex::class)
        ->name('admin.convocatorias');
    });

require __DIR__.'/auth.php';
