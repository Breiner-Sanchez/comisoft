<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::table('actas', function (Blueprint $table) {
        $table->foreignId('user_id')
              ->after('id')
              ->constrained()
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('actas', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

}
