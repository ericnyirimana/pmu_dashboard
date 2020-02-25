<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_pickup', 20); //offer, subscribtion
            $table->bigInteger('timeslot_id')->unsigned();
            $table->bigInteger('restaurant_id')->unsigned();
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->smallInteger('status')->default(0);
            $table->date('date_ini');
            $table->date('date_end');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('media_id')->references('id')->on('media');
            $table->foreign('timeslot_id')->references('id')->on('timeslots')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickups');
    }
}
