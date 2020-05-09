<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsFirstNameLastNameGenderBirtdayTableUsers extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
      
            $table->string('birthday')->after('sub');
            $table->string('gender')->after('sub');
            $table->string('first_name')->after('sub');
            $table->string('last_name')->after('sub');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function(Blueprint $table){

          $table->dropColumn('birthday');
          $table->dropColumn('gender');
          $table->dropColumn('first_name');
          $table->dropColumn('last_name');


      });
    }
}
