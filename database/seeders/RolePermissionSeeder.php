<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Crear roles solo si no existen (evita duplicados)
        Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Creador', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Editor', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Consultor', 'guard_name' => 'web']);

        // Asignar rol Administrador al primer usuario (ID 1)
        $admin = User::find(1);
        if ($admin && !$admin->hasRole('Administrador')) {
            $admin->assignRole('Administrador');
        }

        $this->command->info('Roles creados/verificados correctamente');
    }
}