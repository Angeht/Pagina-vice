<?php

namespace App\Livewire\Admin\DocumentosAcademicos;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\DocumentoAcademico;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';

    public $titulo, $tipo, $descripcion, $archivo, $fecha_publicacion;
    public $orden = 0;
    public $activo = true;
    public $documentoId = null;

    protected function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|in:calendario,reglamento,plan_estudio,directiva',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|mimes:pdf|max:4096',
            'fecha_publicacion' => 'nullable|date',
            'orden' => 'nullable|integer',
            'activo' => 'boolean',
        ];
    }

    public function guardar()
    {
        $this->validate();

        $archivoPath = null;

        if ($this->archivo) {
            $archivoPath = $this->archivo->store('documentos', 'public');
        }

        DocumentoAcademico::updateOrCreate(
            ['id' => $this->documentoId],
            [
                'titulo' => $this->titulo,
                'tipo' => $this->tipo,
                'descripcion' => $this->descripcion,
                'archivo' => $archivoPath,
                'fecha_publicacion' => $this->fecha_publicacion,
                'orden' => $this->orden ?? 0,
                'activo' => $this->activo,
            ]
        );

        session()->flash('message', 'Documento guardado correctamente.');

        $this->reset([
            'titulo','tipo','descripcion','archivo',
            'fecha_publicacion','orden','activo','documentoId'
        ]);

        $this->resetPage();
    }

    public function editar($id)
    {
        $d = DocumentoAcademico::findOrFail($id);

        $this->documentoId = $d->id;
        $this->titulo = $d->titulo;
        $this->tipo = $d->tipo;
        $this->descripcion = $d->descripcion;
        $this->fecha_publicacion = $d->fecha_publicacion;
        $this->orden = $d->orden;
        $this->activo = $d->activo;
    }

    public function eliminar($id)
    {
        DocumentoAcademico::findOrFail($id)->delete();
        session()->flash('message', 'Documento eliminado.');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.documentos-academicos.index', [
            'documentos' => DocumentoAcademico::orderBy('orden')->paginate(6),
        ]);
    }
}