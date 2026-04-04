<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Verificamos que la tabla exista para evitar errores en migraciones
        if (Schema::hasTable('permissions')) {
            $permissions = Permission::all();

            foreach ($permissions as $permission) {
                // Definimos un Gate para cada permiso (ej: 'employees.create')
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->hasPermission($permission->slug);
                });
            }
        }

        // Super Admin: Acceso total sin importar los permisos
        Gate::before(function ($user, $ability) {
            if ($user->role->name === 'admin_sistema') {
                return true;
            }
        });
    }
}
