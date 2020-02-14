<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowcaseTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('showcase_timeslots', function(Blueprint $table){
             $table->increments('id');
             $table->bigInteger('showcase_id')->unsigned();
             $table->bigInteger('timeslot_id')->unsigned();

             $table->foreign('showcase_id')->references('id')->on('showcases')->onDelete('cascade');
             $table->foreign('timeslot_id')->references('id')->on('timeslots')->onDelete('cascade');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::dropIfExists('showcase_timeslots');
     }
}
