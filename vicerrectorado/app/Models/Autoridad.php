<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autoridad extends Model
{
    protected $table = 'autoridades';

    protected $fillable = [
        'nombre',
        'cargo',
        'descripcion',
        'foto',
        'orden',
        'activo',
    ];
}
