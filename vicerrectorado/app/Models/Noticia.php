<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Noticia extends Model
{
    use LogsActivity;

    protected $fillable = [
        'titulo',
        'resumen',
        'contenido',
        'publicado',
        'imagen',
        'user_id',
        'categoria_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($noticia) {

            $slugBase = Str::slug($noticia->titulo);
            $slug = $slugBase;
            $contador = 1;

            while (
                static::where('slug', $slug)
                    ->when($noticia->id, function ($query) use ($noticia) {
                        return $query->where('id', '!=', $noticia->id);
                    })
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $contador++;
            }

            $noticia->slug = $slug;
        });
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['titulo', 'resumen', 'contenido', 'publicado', 'categoria_id'])
            ->setDescriptionForEvent(fn(string $eventName) => "Noticia {$eventName}");
    }
}
