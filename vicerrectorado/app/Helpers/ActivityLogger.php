<?php

namespace App\Helpers;

use Spatie\Activitylog\Facades\LogActivity;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Registra un log personalizado de actividad
     */
    public static function log(string $description, $subject = null, array $properties = [])
    {
        $log = activity()
            ->withProperties($properties);

        if ($subject) {
            $log->performedOn($subject);
        }

        if (Auth::check()) {
            $log->causedBy(Auth::user());
        }

        $log->log($description);
    }

    /**
     * Registra un inicio de sesión
     */
    public static function logLogin($user)
    {
        activity()
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip(), 'user_agent' => request()->userAgent()])
            ->log('Usuario inició sesión');
    }

    /**
     * Registra un cierre de sesión
     */
    public static function logLogout($user)
    {
        activity()
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip()])
            ->log('Usuario cerró sesión');
    }

    /**
     * Registra un cambio de configuración
     */
    public static function logConfigChange(string $key, $oldValue, $newValue)
    {
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'key' => $key,
                'old_value' => $oldValue,
                'new_value' => $newValue,
            ])
            ->log('Configuración actualizada');
    }

    /**
     * Registra una búsqueda
     */
    public static function logSearch(string $query, string $section = 'general')
    {
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'query' => $query,
                'section' => $section,
            ])
            ->log('Búsqueda realizada');
    }
}
