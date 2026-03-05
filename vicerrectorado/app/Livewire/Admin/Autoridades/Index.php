<?php

namespace App\Livewire\Admin\Autoridades;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Autoridad;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';

    public $nombre, $cargo, $descripcion, $foto;
    public $orden = 0;
    public $activo = true;
    public $autoridadId = null;

    protected function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'orden' => 'nullable|integer',
            'activo' => 'boolean',
        ];
    }

    public function guardar()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'cargo' => $this->cargo,
            'descripcion' => $this->descripcion,
            'orden' => $this->orden ?? 0,
            'activo' => $this->activo,
        ];

        // Solo actualizar foto si se subió una nueva
        if ($this->foto) {
            $data['foto'] = $this->foto->store('autoridades', 'public');
        }

        Autoridad::updateOrCreate(
            ['id' => $this->autoridadId],
            $data
        );

        session()->flash('message', 'Autoridad guardada correctamente.');

        $this->reset(['nombre','cargo','descripcion','foto','orden','activo','autoridadId']);
        $this->resetPage();
    }

    public function editar($id)
    {
        $a = Autoridad::findOrFail($id);

        $this->autoridadId = $a->id;
        $this->nombre = $a->nombre;
        $this->cargo = $a->cargo;
        $this->descripcion = $a->descripcion;
        $this->orden = $a->orden;
        $this->activo = $a->activo;
    }

    public function eliminar($id)
    {
        Autoridad::findOrFail($id)->delete();
        session()->flash('message', 'Autoridad eliminada.');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.autoridades.index', [
            'autoridades' => Autoridad::orderBy('orden')->paginate(6),
        ]);
    }
}