<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DocumentoAcademico extends Model
{
    use LogsActivity;
    protected $table = 'documentos_academicos';

    protected $fillable = [
        'titulo',
        'slug',
        'tipo',
        'descripcion',
        'archivo',
        'fecha_publicacion',
        'orden',
        'activo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($doc) {

            $slugBase = Str::slug($doc->titulo);
            $slug = $slugBase;
            $contador = 1;

            while (
                static::where('slug', $slug)
                    ->when($doc->id, function ($query) use ($doc) {
                        return $query->where('id', '!=', $doc->id);
                    })
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $contador++;
            }

            $doc->slug = $slug;
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['titulo', 'tipo', 'descripcion', 'fecha_publicacion', 'orden', 'activo'])
            ->setDescriptionForEvent(fn(string $eventName) => "Documento {$eventName}");
    }
}