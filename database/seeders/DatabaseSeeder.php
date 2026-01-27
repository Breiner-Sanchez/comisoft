<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ficha;
use App\Models\Aprendiz;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Crear segunda ficha con aprendices
        $ficha = Ficha::create([
            'numero' => '231232',
            'programa' => 'Técnico en Agroecología'
        ]);

        // Agregar aprendices a la ficha
        Aprendiz::create([
            'ficha_id' => $ficha->id,
            'nombre' => 'Carlos Gómez',
            'identificacion' => '1098765432',
            'email' => 'carlos.gomez@email.com',
            'novedad' => '',
            'instructor' => '',
            'evidencia' => ''
        ]);

        Aprendiz::create([
            'ficha_id' => $ficha->id,
            'nombre' => 'Ana Martínez',
            'identificacion' => '1087654321',
            'email' => 'ana.martinez@email.com',
            'novedad' => '',
            'instructor' => '',
            'evidencia' => ''
        ]);

        Aprendiz::create([
            'ficha_id' => $ficha->id,
            'nombre' => 'Luis Rodríguez',
            'identificacion' => '1076543210',
            'email' => 'luis.rodriguez@email.com',
            'novedad' => '',
            'instructor' => '',
            'evidencia' => ''
        ]);

        Aprendiz::create([
            'ficha_id' => $ficha->id,
            'nombre' => 'Sandra López',
            'identificacion' => '1065432109',
            'email' => 'sandra.lopez@email.com',
            'novedad' => '',
            'instructor' => '',
            'evidencia' => ''
        ]);
    }
}
