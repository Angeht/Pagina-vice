<?php

namespace App\Livewire\Admin\Configuracion;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Configuracion;

#[Layout('layouts.admin')]
class Banner extends Component
{
    use WithFileUploads;

    public $titulo;
    public $subtitulo;
    public $imagen;
    public $imagen_actual;

    protected function rules()
    {
        return [
            'titulo' => 'nullable|string|max:255',
            'subtitulo' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|max:2048',
        ];
    }

    public function mount()
    {
        $this->titulo = Configuracion::getValor('banner_titulo');
        $this->subtitulo = Configuracion::getValor('banner_subtitulo');
        $this->imagen_actual = Configuracion::getValor('banner_imagen');
    }

    public function guardar()
    {
        $this->validate();

        Configuracion::setValor('banner_titulo', $this->titulo);
        Configuracion::setValor('banner_subtitulo', $this->subtitulo);

        // Solo actualizar imagen si se subió una nueva
        if ($this->imagen) {
            $path = $this->imagen->store('banner', 'public');
            Configuracion::setValor('banner_imagen', $path);
            $this->imagen_actual = $path;
            $this->imagen = null; // Limpiar el temporal
        }

        session()->flash('message', 'Banner actualizado correctamente.');
    }

    public function limpiarImagen()
    {
        $this->imagen = null;
    }

    public function render()
    {
        return view('livewire.admin.configuracion.banner');
    }
}