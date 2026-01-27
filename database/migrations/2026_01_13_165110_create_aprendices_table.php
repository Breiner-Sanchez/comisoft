<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprendicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('aprendices', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ficha_id')->constrained('fichas')->onDelete('cascade');

    $table->string('nombre');
    $table->string('identificacion');
    $table->string('email');

    $table->text('novedad')->nullable();
    $table->string('instructor')->nullable();
    $table->string('evidencia')->nullable();

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
        Schema::dropIfExists('aprendices');
    }
}
