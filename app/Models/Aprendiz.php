<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Aprendiz extends Model
{
    protected $table = 'aprendices';
    
    protected $fillable = [
        'ficha_id',
        'nombre',
        'apellidos',
        'identificacion',
        'celular',
        'email',
        'estado',
        'novedad',
        'instructor',
        'evidencia'
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}

