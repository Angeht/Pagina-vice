<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GaleriaImagen extends Model
{
    protected $table = 'galeria_imagenes';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'orden',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'orden'  => 'integer',
    ];

    /** Scope para imágenes activas ordenadas */
    public function scopeActivas($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderBy('id');
    }

    /** URL completa de la imagen */
    public function getUrlImagenAttribute(): string
    {
        return asset('storage/' . $this->imagen);
    }

    /** Eliminar imagen del disco al borrar el registro */
    protected static function booted(): void
    {
        static::deleting(function (GaleriaImagen $model) {
            if ($model->imagen && Storage::disk('public')->exists($model->imagen)) {
                Storage::disk('public')->delete($model->imagen);
            }
        });
    }
}
