<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Crear los 4 roles
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Creador']);
        Role::create(['name' => 'Editor']);
        Role::create(['name' => 'Consultor']);

        // Asignar rol Administrador al primer usuario (ID = 1)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('Administrador');
        }
    }
}