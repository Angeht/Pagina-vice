<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Noticia extends Model
{
    protected $fillable = [
    'titulo',
    'resumen',
    'contenido',
    'publicado',
    'imagen',
    'user_id',
    'categoria_id',
];

public static function boot()
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

}
