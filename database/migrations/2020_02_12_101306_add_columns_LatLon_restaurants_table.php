<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsLatLonRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function(Blueprint $table){
			$table->float('latitude', 10, 2)->nullable();
			$table->float('longitude', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('restaurants', function(Blueprint $table){

          $table->dropColumn('latitude');
          $table->dropColumn('longitude');

      });
    }
}
