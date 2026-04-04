<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear el Rol Administrador
        $adminRole = \App\Models\Role::create([
            'name' => 'admin_sistema',
            'description' => 'Acceso total al sistema'
        ]);

        // 2. Crear un permiso de prueba (opcional para el Super Admin pero bueno tenerlo)
        $permission = \App\Models\Permission::create([
            'slug' => 'employees.index',
            'description' => 'Ver listado de empleados',
            'module' => 'empleados'
        ]);

        // 3. Crear el Usuario Inicial
        \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'admin@correo.com',
            'password' => bcrypt('admin123'), // Contraseña: admin123
            'role_id' => $adminRole->id
        ]);
    }
}
