<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'programa'];

    public function aprendices()
    {
        return $this->hasMany(Aprendiz::class);
    }

    public function actas()
    {
        return $this->belongsToMany(Acta::class, 'acta_ficha')
            ->withPivot('tema', 'novedad', 'instructor', 'evidencia', 'aprendices_data')
            ->withTimestamps();
    }
}
