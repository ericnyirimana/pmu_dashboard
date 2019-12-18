<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcaseTimeSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcase_time_slot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('showcase_id')->unsigned();
            $table->bigInteger('time_slot_id')->unsigned();
            $table->timestamps();

            $table->foreign('showcase_id')->references('id')->on('showcases')->onDelete('cascade');
            $table->foreign('time_slot_id')->references('id')->on('pu_time_slots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showcase_time_slot');
    }

    
}
