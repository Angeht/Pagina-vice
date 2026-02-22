<?php

namespace App\Livewire\Admin\Categorias;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Categoria;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $nombre;
    public $categoriaId = null;

    protected function rules()
    {
        return [
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $this->categoriaId,
        ];
    }

    public function guardar()
    {
        $this->validate();

        Categoria::updateOrCreate(
            ['id' => $this->categoriaId],
            ['nombre' => $this->nombre]
        );

        session()->flash('message', 'Categoría guardada correctamente.');

        $this->reset(['nombre', 'categoriaId']);
        $this->resetPage();
    }

    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->categoriaId = $categoria->id;
        $this->nombre = $categoria->nombre;
    }

    public function eliminar($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->noticias()->count() > 0) {
            session()->flash('message', 'No se puede eliminar: tiene noticias asociadas.');
            return;
        }

        $categoria->delete();

        session()->flash('message', 'Categoría eliminada.');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.categorias.index', [
            'categorias' => Categoria::orderBy('nombre')->paginate(5)
        ]);
    }
}