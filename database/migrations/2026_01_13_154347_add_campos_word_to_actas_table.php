<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposWordToActasTable extends Migration
{
    public function up()
    {
        Schema::table('actas', function (Blueprint $table) {
            $table->string('nombre_comite')->nullable();
            $table->string('ciudad')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->string('direccion')->nullable();
            $table->string('regional')->nullable();
            $table->string('centro')->nullable();

            $table->text('agenda')->nullable();
            $table->text('objetivos')->nullable();
            $table->longText('desarrollo')->nullable();
            $table->text('conclusiones')->nullable();
            $table->text('compromisos')->nullable();
            $table->text('asistentes')->nullable();
        });
    }

    public function down()
    {
        Schema::table('actas', function (Blueprint $table) {
            $table->dropColumn([
                'nombre_comite',
                'ciudad',
                'hora_inicio',
                'hora_fin',
                'direccion',
                'regional',
                'centro',
                'agenda',
                'objetivos',
                'desarrollo',
                'conclusiones',
                'compromisos',
                'asistentes',
            ]);
        });
    }
}
