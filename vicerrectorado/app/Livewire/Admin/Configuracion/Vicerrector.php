<?php

namespace App\Livewire\Admin\Configuracion;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Configuracion;

#[Layout('layouts.admin')]
class Vicerrector extends Component
{
    use WithFileUploads;

    public $nombre;
    public $texto_presentacion;
    public $cita;
    public $imagen;
    public $imagen_actual;

    protected function rules(): array
    {
        return [
            'nombre'              => 'nullable|string|max:255',
            'texto_presentacion'  => 'nullable|string|max:3000',
            'cita'                => 'nullable|string|max:500',
            'imagen'              => 'nullable|image|max:3072',
        ];
    }

    public function mount(): void
    {
        $this->nombre             = Configuracion::getValor('vicerrector_nombre');
        $this->texto_presentacion = Configuracion::getValor('vicerrector_texto');
        $this->cita               = Configuracion::getValor('vicerrector_cita');
        $this->imagen_actual      = Configuracion::getValor('vicerrector_imagen');
    }

    public function guardar(): void
    {
        $this->validate();

        Configuracion::setValor('vicerrector_nombre', $this->nombre);
        Configuracion::setValor('vicerrector_texto',  $this->texto_presentacion);
        Configuracion::setValor('vicerrector_cita',   $this->cita);

        if ($this->imagen) {
            $path = $this->imagen->store('vicerrector', 'public');
            Configuracion::setValor('vicerrector_imagen', $path);
            $this->imagen_actual = $path;
            $this->imagen = null;
        }

        session()->flash('message', 'Información del Vicerrector actualizada correctamente.');
    }

    public function limpiarImagen(): void
    {
        $this->imagen = null;
    }

    public function render()
    {
        return view('livewire.admin.configuracion.vicerrector');
    }
}
