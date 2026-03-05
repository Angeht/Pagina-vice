<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Resetear caché de roles/permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            // Usuarios
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            
            // Noticias
            'ver noticias',
            'crear noticias',
            'editar noticias',
            'eliminar noticias',
            'publicar noticias',
            
            // Autoridades
            'gestionar autoridades',
            
            // Estructura
            'gestionar estructura',
            
            // Documentos
            'gestionar documentos',
            
            // Convocatorias
            'gestionar convocatorias',
            
            // Configuración
            'gestionar configuracion',
            
            // Logs
            'ver logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        
        // Super Admin - Acceso total
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - Casi todo menos usuarios
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'ver noticias',
            'crear noticias',
            'editar noticias',
            'eliminar noticias',
            'publicar noticias',
            'gestionar autoridades',
            'gestionar estructura',
            'gestionar documentos',
            'gestionar convocatorias',
            'ver logs',
        ]);

        // Editor - Solo contenido
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->givePermissionTo([
            'ver noticias',
            'crear noticias',
            'editar noticias',
            'gestionar documentos',
            'gestionar convocatorias',
        ]);

        // Visor - Solo lectura
        $visor = Role::firstOrCreate(['name' => 'visor']);
        $visor->givePermissionTo([
            'ver noticias',
            'ver logs',
        ]);

        // Asignar super-admin al primer usuario si existe
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->assignRole('super-admin');
            $this->command->info('Usuario "' . $firstUser->name . '" asignado como super-admin');
        }

        $this->command->info('Roles y permisos creados exitosamente!');
        $this->command->info('Roles creados: super-admin, admin, editor, visor');
    }
}
