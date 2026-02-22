<?php

namespace App\Livewire\Admin\Convocatorias;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Convocatoria;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';

    public $titulo, $tipo, $descripcion;
    public $fecha_inicio, $fecha_cierre;
    public $archivo;
    public $activo = true;
    public $convocatoriaId = null;

    protected function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|in:docente,estudiante,beca,concurso',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_cierre' => 'required|date|after_or_equal:fecha_inicio',
            'archivo' => 'nullable|mimes:pdf|max:4096',
            'activo' => 'boolean',
        ];
    }

    public function guardar()
    {
        $this->validate();

        $archivoPath = null;

        if ($this->archivo) {
            $archivoPath = $this->archivo->store('convocatorias', 'public');
        }

        Convocatoria::updateOrCreate(
            ['id' => $this->convocatoriaId],
            [
                'titulo' => $this->titulo,
                'tipo' => $this->tipo,
                'descripcion' => $this->descripcion,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_cierre' => $this->fecha_cierre,
                'archivo' => $archivoPath,
                'activo' => $this->activo,
            ]
        );

        session()->flash('message', 'Convocatoria guardada correctamente.');

        $this->reset([
            'titulo','tipo','descripcion',
            'fecha_inicio','fecha_cierre',
            'archivo','activo','convocatoriaId'
        ]);

        $this->resetPage();
    }

    public function editar($id)
    {
        $c = Convocatoria::findOrFail($id);

        $this->convocatoriaId = $c->id;
        $this->titulo = $c->titulo;
        $this->tipo = $c->tipo;
        $this->descripcion = $c->descripcion;
        $this->fecha_inicio = $c->fecha_inicio?->format('Y-m-d');
        $this->fecha_cierre = $c->fecha_cierre?->format('Y-m-d');
        $this->activo = $c->activo;
    }

    public function eliminar($id)
    {
        Convocatoria::findOrFail($id)->delete();
        session()->flash('message', 'Convocatoria eliminada.');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.convocatorias.index', [
            'convocatorias' => Convocatoria::latest()->paginate(6),
        ]);
    }
}