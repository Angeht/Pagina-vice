<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $fillable = ['clave', 'valor'];

    public static function getValor($clave)
    {
        return static::where('clave', $clave)->value('valor');
    }

    public static function setValor($clave, $valor)
    {
        return static::updateOrCreate(
            ['clave' => $clave],
            ['valor' => $valor]
        );
    }
}