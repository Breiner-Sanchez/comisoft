<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('reportado_por');
            $table->string('correo_reporte');
            $table->string('telefono_reporte')->nullable();
            $table->string('programa')->nullable();
            $table->string('ficha_numero')->nullable();
            $table->string('tipo_programa')->nullable();
            $table->string('aprendiz_nombre');
            $table->string('aprendiz_documento');
            $table->string('aprendiz_tipo_doc')->nullable();
            $table->string('aprendiz_correo')->nullable();
            $table->string('aprendiz_telefono')->nullable();
            $table->string('aprendiz_estado')->nullable();
            $table->text('motivo_solicitud');
            $table->string('evidencia_archivo')->nullable();
            $table->string('estado')->default('pendiente'); // pendiente, procesada, rechazada
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
        Schema::dropIfExists('solicitudes');
    }
}
