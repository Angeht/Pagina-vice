<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class ActivityLogObserver
{
    /**
     * Este observer se ejecuta antes de registrar cualquier actividad
     * para asociar automáticamente el usuario autenticado.
     */
    public function creating($activity)
    {
        if (Auth::check() && !$activity->causer_id) {
            $activity->causer_id = Auth::id();
            $activity->causer_type = get_class(Auth::user());
        }
    }
}
