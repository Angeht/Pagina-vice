<?php

namespace App\Livewire\Admin\Galeria;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\GaleriaImagen;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithFileUploads;

    // Subida de nuevas imágenes
    public $nuevasImagenes = [];
    public string $nuevoTitulo = '';
    public string $nuevaDescripcion = '';

    // Edición de título/descripción en línea
    public ?int $editandoId = null;
    public string $editTitulo = '';
    public string $editDescripcion = '';

    // Confirmar eliminación
    public ?int $eliminandoId = null;

    protected function rules(): array
    {
        return [
            'nuevasImagenes.*'  => 'required|image|max:4096',
            'nuevoTitulo'       => 'nullable|string|max:200',
            'nuevaDescripcion'  => 'nullable|string|max:500',
            'editTitulo'        => 'nullable|string|max:200',
            'editDescripcion'   => 'nullable|string|max:500',
        ];
    }

    /** Subir una o varias imágenes */
    public function guardar(): void
    {
        $this->validate([
            'nuevasImagenes'   => 'required|array|min:1',
            'nuevasImagenes.*' => 'required|image|max:4096',
            'nuevoTitulo'      => 'nullable|string|max:200',
            'nuevaDescripcion' => 'nullable|string|max:500',
        ]);

        $maxOrden = GaleriaImagen::max('orden') ?? 0;

        foreach ($this->nuevasImagenes as $archivo) {
            $path = $archivo->store('galeria', 'public');

            GaleriaImagen::create([
                'titulo'      => $this->nuevoTitulo ?: null,
                'descripcion' => $this->nuevaDescripcion ?: null,
                'imagen'      => $path,
                'orden'       => ++$maxOrden,
                'activo'      => true,
            ]);
        }

        $this->reset(['nuevasImagenes', 'nuevoTitulo', 'nuevaDescripcion']);
        session()->flash('message', 'Imágenes subidas correctamente.');
    }

    /** Abrir edición */
    public function editar(int $id): void
    {
        $imagen = GaleriaImagen::findOrFail($id);
        $this->editandoId     = $id;
        $this->editTitulo     = $imagen->titulo ?? '';
        $this->editDescripcion = $imagen->descripcion ?? '';
    }

    /** Guardar edición de texto */
    public function guardarEdicion(): void
    {
        $this->validate([
            'editTitulo'      => 'nullable|string|max:200',
            'editDescripcion' => 'nullable|string|max:500',
        ]);

        GaleriaImagen::findOrFail($this->editandoId)->update([
            'titulo'      => $this->editTitulo ?: null,
            'descripcion' => $this->editDescripcion ?: null,
        ]);

        $this->reset(['editandoId', 'editTitulo', 'editDescripcion']);
        session()->flash('message', 'Imagen actualizada correctamente.');
    }

    /** Cancelar edición */
    public function cancelarEdicion(): void
    {
        $this->reset(['editandoId', 'editTitulo', 'editDescripcion']);
    }

    /** Toggle activo */
    public function toggleActivo(int $id): void
    {
        $imagen = GaleriaImagen::findOrFail($id);
        $imagen->update(['activo' => !$imagen->activo]);
    }

    /** Mover orden arriba */
    public function subirOrden(int $id): void
    {
        $imagen = GaleriaImagen::findOrFail($id);
        $anterior = GaleriaImagen::where('orden', '<', $imagen->orden)
            ->orderByDesc('orden')->first();

        if ($anterior) {
            [$imagen->orden, $anterior->orden] = [$anterior->orden, $imagen->orden];
            $imagen->save();
            $anterior->save();
        }
    }

    /** Mover orden abajo */
    public function bajarOrden(int $id): void
    {
        $imagen = GaleriaImagen::findOrFail($id);
        $siguiente = GaleriaImagen::where('orden', '>', $imagen->orden)
            ->orderBy('orden')->first();

        if ($siguiente) {
            [$imagen->orden, $siguiente->orden] = [$siguiente->orden, $imagen->orden];
            $imagen->save();
            $siguiente->save();
        }
    }

    /** Confirmar eliminación */
    public function confirmarEliminar(int $id): void
    {
        $this->eliminandoId = $id;
    }

    /** Cancelar eliminación */
    public function cancelarEliminar(): void
    {
        $this->eliminandoId = null;
    }

    /** Eliminar imagen */
    public function eliminar(): void
    {
        if ($this->eliminandoId) {
            GaleriaImagen::findOrFail($this->eliminandoId)->delete();
            $this->eliminandoId = null;
            session()->flash('message', 'Imagen eliminada correctamente.');
        }
    }

    public function render()
    {
        $imagenes = GaleriaImagen::orderBy('orden')->orderBy('id')->get();
        return view('livewire.admin.galeria.index', compact('imagenes'));
    }
}
