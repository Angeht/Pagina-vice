<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Categoria extends Model
{
    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nombre', 'slug'])
            ->setDescriptionForEvent(fn(string $eventName) => "Categoria {$eventName}");
    }
}
