<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAddressLatitudeLongitudeTableUsers extends Migration


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

            $table->string('longitude')->after('first_name');
            $table->string('latitude')->after('first_name');
            $table->string('address')->after('first_name');
            
			
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

        $table->dropColumn('longitude');
        $table->dropColumn('latitude');
        $table->dropColumn('address');
          

      });
    }
}
