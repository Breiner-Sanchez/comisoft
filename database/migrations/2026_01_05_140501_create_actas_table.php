<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('actas', function (Blueprint $table) {
    $table->id();
    $table->string('numero_acta')->unique();
    $table->string('titulo');
    $table->date('fecha');
    $table->string('lugar');
    $table->text('participantes');
    $table->longText('contenido');
    $table->string('estado')->default('borrador');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actas');
    }
}
