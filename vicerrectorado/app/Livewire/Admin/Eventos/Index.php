<?php

namespace App\Livewire\Admin\Eventos;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Evento;
use App\Models\GaleriaEvento;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';

    // Control de visibilidad del formulario
    public bool $mostrarFormulario = false;

    // Formulario principal
    public $eventoId = null;
    public $titulo     = '';
    public $descripcion = '';
    public $contenido  = '';
    public $fecha_inicio = '';
    public $fecha_fin    = '';
    public $lugar      = '';
    public $imagen_portada;
    public $activo     = true;
    public $destacado  = false;

    // Galería
    public $galeriaEventoId = null;  // qué evento tiene la galería abierta
    public $nuevaImagenGaleria;
    public $nuevaDescGaleria = '';

    public $busqueda = '';

    protected function rules(): array
    {
        return [
            'titulo'          => 'required|string|max:255',
            'descripcion'     => 'nullable|string',
            'contenido'       => 'nullable|string',
            'fecha_inicio'    => 'nullable|date',
            'fecha_fin'       => 'nullable|date|after_or_equal:fecha_inicio',
            'lugar'           => 'nullable|string|max:255',
            'imagen_portada'  => 'nullable|image|max:3072',
            'activo'          => 'boolean',
            'destacado'       => 'boolean',
        ];
    }

    public function updatingBusqueda(): void
    {
        $this->resetPage();
    }

    public function nuevoEvento(): void
    {
        $this->limpiarFormulario();
        $this->mostrarFormulario = true;
    }

    public function guardar(): void
    {
        $this->validate();

        $data = [
            'titulo'      => $this->titulo,
            'descripcion' => $this->descripcion,
            'contenido'   => $this->contenido,
            'fecha_inicio'=> $this->fecha_inicio ?: null,
            'fecha_fin'   => $this->fecha_fin    ?: null,
            'lugar'       => $this->lugar,
            'activo'      => $this->activo,
            'destacado'   => $this->destacado,
        ];

        if ($this->imagen_portada) {
            $data['imagen_portada'] = $this->imagen_portada->store('eventos', 'public');
        }

        Evento::updateOrCreate(['id' => $this->eventoId], $data);

        $this->limpiarFormulario();
        $this->mostrarFormulario = false;
        session()->flash('message', 'Evento guardado exitosamente.');
        $this->resetPage();
    }

    public function editar(int $id): void
    {
        $evento = Evento::findOrFail($id);
        $this->mostrarFormulario = true;

        $this->eventoId    = $evento->id;
        $this->titulo      = $evento->titulo;
        $this->descripcion = $evento->descripcion ?? '';
        $this->contenido   = $evento->contenido   ?? '';
        $this->fecha_inicio = $evento->fecha_inicio ? $evento->fecha_inicio->format('Y-m-d\TH:i') : '';
        $this->fecha_fin    = $evento->fecha_fin    ? $evento->fecha_fin->format('Y-m-d\TH:i')    : '';
        $this->lugar       = $evento->lugar   ?? '';
        $this->activo      = $evento->activo;
        $this->destacado   = $evento->destacado;
        $this->imagen_portada = null;
    }

    public function eliminar(int $id): void
    {
        Evento::findOrFail($id)->delete();
        session()->flash('message', 'Evento eliminado.');
    }

    public function limpiarFormulario(): void
    {
        $this->reset([
            'eventoId', 'titulo', 'descripcion', 'contenido',
            'fecha_inicio', 'fecha_fin', 'lugar',
            'imagen_portada', 'activo', 'destacado',
        ]);
        $this->activo = true;
        $this->mostrarFormulario = false;
        $this->resetValidation();
    }

    // ─── GALERÍA ──────────────────────────────────────────────────────────────

    public function abrirGaleria(int $eventoId): void
    {
        $this->galeriaEventoId = $eventoId;
        $this->nuevaImagenGaleria = null;
        $this->nuevaDescGaleria = '';
    }

    public function cerrarGaleria(): void
    {
        $this->galeriaEventoId = null;
        $this->nuevaImagenGaleria = null;
        $this->nuevaDescGaleria = '';
    }

    public function subirImagenGaleria(): void
    {
        $this->validate([
            'nuevaImagenGaleria' => 'required|image|max:3072',
        ]);

        $ruta = $this->nuevaImagenGaleria->store('galeria-eventos', 'public');

        $maxOrden = GaleriaEvento::where('evento_id', $this->galeriaEventoId)->max('orden') ?? 0;

        GaleriaEvento::create([
            'evento_id'   => $this->galeriaEventoId,
            'imagen'      => $ruta,
            'descripcion' => $this->nuevaDescGaleria,
            'orden'       => $maxOrden + 1,
        ]);

        $this->nuevaImagenGaleria = null;
        $this->nuevaDescGaleria   = '';
        session()->flash('galeriaMessage', 'Imagen subida correctamente.');
    }

    public function eliminarImagenGaleria(int $galeriaId): void
    {
        $imagen = GaleriaEvento::findOrFail($galeriaId);
        // Eliminar archivo físico si existe
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagen->imagen)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($imagen->imagen);
        }
        $imagen->delete();
    }

    public function render()
    {
        $eventos = Evento::when($this->busqueda, fn($q) =>
                $q->where('titulo', 'like', '%' . $this->busqueda . '%')
                  ->orWhere('lugar', 'like', '%' . $this->busqueda . '%')
            )
            ->latest()
            ->paginate(10);

        $galeriaActual = $this->galeriaEventoId
            ? GaleriaEvento::where('evento_id', $this->galeriaEventoId)->orderBy('orden')->get()
            : collect();

        $eventoGaleria = $this->galeriaEventoId
            ? Evento::find($this->galeriaEventoId)
            : null;

        return view('livewire.admin.eventos.index', compact('eventos', 'galeriaActual', 'eventoGaleria'));
    }
}
