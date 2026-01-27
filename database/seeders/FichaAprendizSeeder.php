<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FichaAprendizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $ficha = \App\Models\Ficha::create([
                'numero' => 'FICHA-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'programa' => 'Programa de Prueba ' . $i,
            ]);

            for ($j = 1; $j <= 5; $j++) {
                \App\Models\Aprendiz::create([
                    'ficha_id' => $ficha->id,
                    'nombre' => "Aprendiz {$j} de Ficha {$i}",
                    'identificacion' => "ID-{$i}-{$j}",
                    'email' => "aprendiz{$i}_{$j}@example.com",
                ]);
            }
        }
    }
}
