<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('operators', function (Blueprint $table) {
          $table->dropColumn('password');
          $table->dropForeign('operators_role_type_id_foreign');
          $table->dropColumn('role_type_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('operators', function (Blueprint $table) {
            $table->string('password');
            $table->integer('role_type_id')->unsigned();
      });
    }
}
