<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Convocatoria extends Model
{
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
        'fecha_inicio' => 'date',
        'fecha_cierre' => 'date',
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
}