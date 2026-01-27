<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAprendicesDataToActaFichaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acta_ficha', function (Blueprint $table) {
            $table->json('aprendices_data')->nullable();
        });
    }

    public function down()
    {
        Schema::table('acta_ficha', function (Blueprint $table) {
            $table->dropColumn('aprendices_data');
        });
    }
}
