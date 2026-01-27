<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSolicitudIdToActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actas', function (Blueprint $table) {
            $table->foreignId('solicitud_id')->nullable()->constrained('solicitudes')->onDelete('set null');
            
            // Remove the fields that are now in solicitudes
            $table->dropColumn([
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
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('solicitud_id');
            
            $table->string('reportado_por')->nullable();
            $table->string('correo_reporte')->nullable();
            $table->string('telefono_reporte')->nullable();
            $table->string('programa')->nullable();
            $table->string('ficha_numero')->nullable();
            $table->string('tipo_programa')->nullable();
            $table->string('aprendiz_nombre')->nullable();
            $table->string('aprendiz_documento')->nullable();
            $table->string('aprendiz_tipo_doc')->nullable();
            $table->string('aprendiz_correo')->nullable();
            $table->string('aprendiz_telefono')->nullable();
            $table->string('aprendiz_estado')->nullable();
            $table->text('motivo_solicitud')->nullable();
            $table->string('evidencia_archivo')->nullable();
        });
    }
}
