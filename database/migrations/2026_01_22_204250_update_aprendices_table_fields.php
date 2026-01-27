<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAprendicesTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aprendices', function (Blueprint $table) {
            $table->string('apellidos')->after('nombre')->nullable();
            $table->string('celular')->after('apellidos')->nullable();
            $table->string('estado')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aprendices', function (Blueprint $table) {
            $table->dropColumn(['apellidos', 'celular', 'estado']);
        });
    }
}
