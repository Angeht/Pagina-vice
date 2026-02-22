<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Autoridad extends Model
{
    use LogsActivity;
    protected $table = 'autoridades';

    protected $fillable = [
        'nombre',
        'cargo',
        'descripcion',
        'foto',
        'orden',
        'activo',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nombre', 'cargo', 'descripcion', 'orden', 'activo'])
            ->setDescriptionForEvent(fn(string $eventName) => "Autoridad {$eventName}");
    }
}
