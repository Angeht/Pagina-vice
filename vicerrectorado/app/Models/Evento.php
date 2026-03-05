<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Carbon\Carbon;

class Evento extends Model
{
    use LogsActivity;

    protected $fillable = [
        'titulo',
        'slug',
        'descripcion',
        'contenido',
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'imagen_portada',
        'activo',
        'destacado',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin'    => 'datetime',
        'activo'       => 'boolean',
        'destacado'    => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($evento) {
            $slugBase = Str::slug($evento->titulo);
            $slug = $slugBase;
            $contador = 1;

            while (
                static::where('slug', $slug)
                    ->when($evento->id, fn($q) => $q->where('id', '!=', $evento->id))
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $contador++;
            }

            $evento->slug = $slug;
        });
    }

    public function galeria()
    {
        return $this->hasMany(GaleriaEvento::class)->orderBy('orden');
    }

    /**
     * Estado del evento: 'proximo', 'en_curso', 'finalizado'
     */
    public function getEstadoAttribute(): string
    {
        $now = Carbon::now();

        if ($this->fecha_inicio && $this->fecha_inicio->isFuture()) {
            return 'proximo';
        }

        if ($this->fecha_fin && $this->fecha_fin->isFuture()) {
            return 'en_curso';
        }

        return 'finalizado';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'lugar', 'activo', 'destacado'])
            ->setDescriptionForEvent(fn(string $eventName) => "Evento {$eventName}");
    }
}
