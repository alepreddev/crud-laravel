<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable; // Importamos tu Trait de auditoría
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use Auditable;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',
        'id_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'hire_date',
        'is_active'
    ];

    // Relación: Un empleado puede tener un usuario asignado (opcional)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accesor para nombre completo (útil para la vista)
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}