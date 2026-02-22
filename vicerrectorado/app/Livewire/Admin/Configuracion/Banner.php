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

    public function mount()
    {
        $this->titulo = Configuracion::getValor('banner_titulo');
        $this->subtitulo = Configuracion::getValor('banner_subtitulo');
    }

    public function guardar()
    {
        Configuracion::setValor('banner_titulo', $this->titulo);
        Configuracion::setValor('banner_subtitulo', $this->subtitulo);

        if ($this->imagen) {
            $path = $this->imagen->store('banner', 'public');
            Configuracion::setValor('banner_imagen', $path);
        }

        session()->flash('message', 'Banner actualizado correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.configuracion.banner');
    }
}