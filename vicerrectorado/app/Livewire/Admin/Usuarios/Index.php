<?php

namespace App\Livewire\Admin\Usuarios;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $name, $email, $password, $password_confirmation;
    public $userId = null;
    public $selectedRoles = [];
    public $activo = true;
    public $buscar = '';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'activo' => 'boolean',
        ];

        if (!$this->userId || $this->password) {
            $rules['password'] = ['required', 'confirmed', Password::min(8)];
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'El nombre es obligatorio',
        'email.required' => 'El email es obligatorio',
        'email.email' => 'Ingrese un email válido',
        'email.unique' => 'Este email ya está registrado',
        'password.required' => 'La contraseña es obligatoria',
        'password.confirmed' => 'Las contraseñas no coinciden',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres',
    ];

    public function guardar()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        // Solo actualizar password si se proporcionó uno nuevo
        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user = User::updateOrCreate(
            ['id' => $this->userId],
            $data
        );

        // Sincronizar roles
        $user->syncRoles($this->selectedRoles);

        session()->flash('message', $this->userId ? 'Usuario actualizado correctamente.' : 'Usuario creado correctamente.');

        $this->reset(['name', 'email', 'password', 'password_confirmation', 'userId', 'selectedRoles', 'activo']);
        $this->resetPage();
    }

    public function editar($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles->pluck('name')->toArray();
        $this->activo = true;
    }

    public function eliminar($id)
    {
        $user = User::findOrFail($id);
        $currentUserId = auth()->user()->id;
        
        // No permitir eliminar el usuario actual
        if ($user->id == $currentUserId) {
            session()->flash('error', 'No puedes eliminar tu propia cuenta.');
            return;
        }

        $user->delete();
        session()->flash('message', 'Usuario eliminado correctamente.');
        $this->resetPage();
    }

    public function cancelar()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'userId', 'selectedRoles', 'activo']);
    }

    public function limpiarBusqueda()
    {
        $this->buscar = '';
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        if ($this->buscar) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->buscar . '%')
                  ->orWhere('email', 'like', '%' . $this->buscar . '%');
            });
        }

        return view('livewire.admin.usuarios.index', [
            'usuarios' => $query->with('roles')->latest()->paginate(10),
            'roles' => Role::all(),
        ]);
    }
}
