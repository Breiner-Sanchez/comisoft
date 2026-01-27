<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id',
        'reportado_por',
        'correo_reporte',
        'telefono_reporte',
        'programa',
        'ficha_numero',
        'tipo_programa',
        'aprendiz_nombre',
        'aprendiz_documento',
        'aprendiz_tipo_doc',
        'aprendiz_correo',
        'aprendiz_telefono',
        'aprendiz_estado',
        'motivo_solicitud',
        'evidencia_archivo',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acta()
    {
        return $this->hasOne(Acta::class);
    }
}
