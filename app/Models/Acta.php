<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitud_id',
        'numero_acta',
        'acta_numero',
        'acta_año',
        'titulo',
        'fecha',
        'lugar',
        'participantes',
        'estado',
        'user_id',

        // CAMPOS DEL WORD
        'nombre_comite',
        'ciudad',
        'hora_inicio',
        'hora_fin',
        'direccion',
        'regional',
        'centro',
        'agenda',
        'objetivos',
        'descripcion_desarrollo',
        'desarrollo',
        'conclusiones',
        'compromisos',
        'asistentes',
        'evidencia_asistentes',
    ];

    protected $casts = [
        'compromisos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    public function fichas()
    {
        return $this->belongsToMany(Ficha::class, 'acta_ficha')
            ->withPivot('tema', 'novedad', 'instructor', 'evidencia', 'aprendices_data')
            ->withTimestamps();
    }
}
