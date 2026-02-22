<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unidad extends Model
{
    protected $table = 'unidades';

    protected $fillable = [
        'nombre',
        'slug',
        'tipo',
        'responsable',
        'descripcion',
        'correo',
        'telefono',
        'imagen',
        'orden',
        'activo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($unidad) {

            $slugBase = Str::slug($unidad->nombre);
            $slug = $slugBase;
            $contador = 1;

            while (
                static::where('slug', $slug)
                    ->when($unidad->id, function ($query) use ($unidad) {
                        return $query->where('id', '!=', $unidad->id);
                    })
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $contador++;
            }

            $unidad->slug = $slug;
        });
    }
}