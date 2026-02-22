<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($categoria) {
            $categoria->slug = Str::slug($categoria->nombre);
        });
    }

    public function noticias()
    {
        return $this->hasMany(Noticia::class);
    }
}
