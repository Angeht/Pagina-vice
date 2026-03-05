<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriaEvento extends Model
{
    protected $fillable = [
        'evento_id',
        'imagen',
        'descripcion',
        'orden',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
