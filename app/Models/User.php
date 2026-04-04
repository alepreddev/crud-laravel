<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Auditable;

class User extends Authenticatable
{
    use Notifiable, Auditable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relación con el Rol
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Verificar si tiene un permiso específico
    public function hasPermission($permissionSlug)
    {
        if (!$this->role) return false;
        return $this->role->permissions->contains('slug', $permissionSlug);
    }
}