<?php

namespace App\Livewire\Admin\DocumentosAcademicos;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\DocumentoAcademico;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';

    public $titulo, $tipo, $descripcion, $archivo, $fecha_publicacion;
    public $activo = true;
    public $documentoId = null;
    public $confirmandoEliminar = null;

    protected function rules()
    {
        return [
            'titulo'            => 'required|string|max:255',
            'tipo'              => 'required|in:calendario,reglamento,plan_estudio,directiva',
            'descripcion'       => 'nullable|string',
            'archivo'           => 'nullable|mimes:pdf|max:10240',
            'fecha_publicacion' => 'nullable|date',
            'activo'            => 'boolean',
        ];
    }

    public function guardar()
    {
        $this->validate();

        $data = [
            'titulo'            => $this->titulo,
            'tipo'              => $this->tipo,
            'descripcion'       => $this->descripcion,
            'fecha_publicacion' => $this->fecha_publicacion ?: now()->toDateString(),
            'activo'            => $this->activo,
        ];

        if ($this->archivo) {
            $data['archivo'] = $this->archivo->store('documentos', 'public');
        }

        DocumentoAcademico::updateOrCreate(
            ['id' => $this->documentoId],
            $data
        );

        session()->flash('message', $this->documentoId ? 'Documento actualizado correctamente.' : 'Documento guardado correctamente.');

        $this->reset(['titulo','tipo','descripcion','archivo','fecha_publicacion','activo','documentoId']);
        $this->resetPage();
    }

    public function editar($id)
    {
        $d = DocumentoAcademico::findOrFail($id);
        $this->documentoId       = $d->id;
        $this->titulo            = $d->titulo;
        $this->tipo              = $d->tipo;
        $this->descripcion       = $d->descripcion;
        $this->fecha_publicacion = $d->fecha_publicacion;
        $this->activo            = $d->activo;
        $this->archivo           = null;
        $this->dispatch('editar-documento');
    }

    public function cancelarEdicion()
    {
        $this->reset(['titulo','tipo','descripcion','archivo','fecha_publicacion','activo','documentoId']);
    }

    public function confirmarEliminar($id)
    {
        $this->confirmandoEliminar = $id;
    }

    public function cancelarEliminar()
    {
        $this->confirmandoEliminar = null;
    }

    public function eliminar()
    {
        if ($this->confirmandoEliminar) {
            $doc = DocumentoAcademico::findOrFail($this->confirmandoEliminar);
            if ($doc->archivo) {
                Storage::disk('public')->delete($doc->archivo);
            }
            $doc->delete();
            $this->confirmandoEliminar = null;
            session()->flash('message', 'Documento eliminado.');
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.documentos-academicos.index', [
            'documentos' => DocumentoAcademico::orderByDesc('fecha_publicacion')->orderByDesc('created_at')->paginate(10),
        ]);
    }
}