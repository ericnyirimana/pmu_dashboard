<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pickup_id')->unsigned();
            $table->bigInteger('media_id')->unsigned();
            $table->timestamps();

            $table->foreign('pickup_id')->references('id')->on('pickups')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickup_media');
    }
}
