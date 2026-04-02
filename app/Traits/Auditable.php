<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    // Boot del trait: Laravel lo ejecuta automáticamente al iniciar el modelo
    protected static function bootAuditable()
    {
        static::created(fn ($model) => $model->audit('create', null, $model->getAttributes()));

        static::updating(function ($model) {
            $model->audit('update', $model->getOriginal(), $model->getDirty());
        });

        static::deleted(fn ($model) => $model->audit('delete', $model->getAttributes(), null));
    }

    protected function audit($event, $oldValues, $newValues)
    {
        Audit::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'auditable_type' => get_class($this),
            'auditable_id' => $this->id,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}