<?php

namespace App\Livewire\Admin\Unidades;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Unidad;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';

    public $nombre, $tipo, $responsable, $descripcion, $correo, $telefono, $imagen;
    public $orden = 0;
    public $activo = true;
    public $unidadId = null;

    protected function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:direccion,unidad',
            'responsable' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'correo' => 'nullable|email',
            'telefono' => 'nullable|string|max:50',
            'imagen' => 'nullable|image|max:2048',
            'orden' => 'nullable|integer',
            'activo' => 'boolean',
        ];
    }

    public function guardar()
    {
        $this->validate();

        $imagenPath = null;

        if ($this->imagen) {
            $imagenPath = $this->imagen->store('unidades', 'public');
        }

        Unidad::updateOrCreate(
            ['id' => $this->unidadId],
            [
                'nombre' => $this->nombre,
                'tipo' => $this->tipo,
                'responsable' => $this->responsable,
                'descripcion' => $this->descripcion,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
                'imagen' => $imagenPath,
                'orden' => $this->orden ?? 0,
                'activo' => $this->activo,
            ]
        );

        session()->flash('message', 'Unidad guardada correctamente.');

        $this->reset([
            'nombre','tipo','responsable','descripcion',
            'correo','telefono','imagen','orden','activo','unidadId'
        ]);

        $this->resetPage();
    }

    public function editar($id)
    {
        $u = Unidad::findOrFail($id);

        $this->unidadId = $u->id;
        $this->nombre = $u->nombre;
        $this->tipo = $u->tipo;
        $this->responsable = $u->responsable;
        $this->descripcion = $u->descripcion;
        $this->correo = $u->correo;
        $this->telefono = $u->telefono;
        $this->orden = $u->orden;
        $this->activo = $u->activo;
    }

    public function eliminar($id)
    {
        Unidad::findOrFail($id)->delete();
        session()->flash('message', 'Unidad eliminada.');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.unidades.index', [
            'unidades' => Unidad::orderBy('orden')->paginate(6),
        ]);
    }
}