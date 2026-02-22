<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Convocatoria extends Model
{
    use LogsActivity;
    protected $fillable = [
        'titulo',
        'slug',
        'tipo',
        'descripcion',
        'fecha_inicio',
        'fecha_cierre',
        'archivo',
        'activo',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_cierre' => 'datetime',
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($convocatoria) {

            $slugBase = Str::slug($convocatoria->titulo);
            $slug = $slugBase;
            $contador = 1;

            while (
                static::where('slug', $slug)
                    ->when($convocatoria->id, function ($query) use ($convocatoria) {
                        return $query->where('id', '!=', $convocatoria->id);
                    })
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $contador++;
            }

            $convocatoria->slug = $slug;
        });
    }

    // 🔥 Estado automático
    public function getEstadoAttribute()
    {
        $hoy = Carbon::today();

        if ($hoy->lt($this->fecha_inicio)) {
            return 'proxima';
        }

        if ($hoy->between($this->fecha_inicio, $this->fecha_cierre)) {
            return 'abierta';
        }

        return 'cerrada';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['titulo', 'tipo', 'descripcion', 'fecha_inicio', 'fecha_cierre', 'activo'])
            ->setDescriptionForEvent(fn(string $eventName) => "Convocatoria {$eventName}");
    }
}