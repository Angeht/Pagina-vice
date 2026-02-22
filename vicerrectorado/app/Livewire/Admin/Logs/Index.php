<?php

namespace App\Livewire\Admin\Logs;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Spatie\Activitylog\Models\Activity;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $filtroModelo = '';
    public $filtroEvento = '';
    public $busqueda = '';

    public function updatingFiltroModelo()
    {
        $this->resetPage();
    }

    public function updatingFiltroEvento()
    {
        $this->resetPage();
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Activity::with(['causer', 'subject'])
            ->latest();

        // Filtro por modelo
        if ($this->filtroModelo) {
            $query->where('subject_type', $this->filtroModelo);
        }

        // Filtro por evento
        if ($this->filtroEvento) {
            $query->where('description', 'like', "%{$this->filtroEvento}%");
        }

        // Búsqueda
        if ($this->busqueda) {
            $query->where(function($q) {
                $q->where('description', 'like', "%{$this->busqueda}%")
                  ->orWhereJsonContains('properties', $this->busqueda);
            });
        }

        $logs = $query->paginate(20);

        // Obtener modelos únicos para el filtro
        $modelos = Activity::select('subject_type')
            ->distinct()
            ->pluck('subject_type')
            ->filter()
            ->map(fn($type) => [
                'value' => $type,
                'label' => class_basename($type)
            ]);

        return view('livewire.admin.logs.index', compact('logs', 'modelos'));
    }
}
