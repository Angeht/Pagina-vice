<?php

namespace App\Livewire\Admin\Noticias;

use Livewire\Component;
use App\Models\Noticia;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Categoria;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;
    use WithPagination, WithFileUploads;

    
    public $categoria_id;
    public $imagen;
    protected $paginationTheme = 'tailwind';

    public $titulo, $resumen, $contenido, $publicado = false;
    public $noticiaId = null;

    protected $rules = [
        'titulo' => 'required|string|max:255',
        'contenido' => 'required',
    ];

    public function guardar()
    {
        $imagenPath = null;

        if ($this->imagen) {
            $imagenPath = $this->imagen->store('noticias', 'public');
        }

        Noticia::updateOrCreate(
            ['id' => $this->noticiaId],
            [
                'titulo' => $this->titulo,
                'resumen' => $this->resumen,
                'contenido' => $this->contenido,
                'publicado' => $this->publicado,
                'imagen' => $imagenPath,
                'user_id' => Auth::id(),
                'categoria_id' => $this->categoria_id,
            ]
        );

        $this->reset(['titulo', 'resumen', 'contenido', 'publicado', 'noticiaId', 'imagen', 'categoria_id']);

        session()->flash('message', 'Noticia guardada exitosamente.');

        $this->resetPage();
    }

    public function editar($id)
    {
        $noticia = Noticia::findOrFail($id);

        $this->noticiaId = $noticia->id;
        $this->titulo = $noticia->titulo;
        $this->resumen = $noticia->resumen;
        $this->contenido = $noticia->contenido;
        $this->publicado = $noticia->publicado;
        $this->categoria_id = $noticia->categoria_id;
    }

    public function limpiarImagen()
    {
        $this->imagen = null;
    }

    public function cancelar()
    {
        $this->reset(['titulo', 'resumen', 'contenido', 'publicado', 'noticiaId', 'imagen', 'categoria_id']);
    }

    public function eliminar($id)
    {
        Noticia::findOrFail($id)->delete();

        session()->flash('message', 'Noticia eliminada correctamente.');

        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.noticias.index', [
            'noticias' => Noticia::latest()->paginate(5),
            'categorias' => Categoria::all(),
        ]);
    }
}
