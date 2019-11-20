<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPuTimeSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_pu_time_slot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pu_time_slot_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('pu_time_slot_id')->references('id')->on('pu_time_slots')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_pu_time_slot');
    }
}
