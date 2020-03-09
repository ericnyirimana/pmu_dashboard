<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pickups', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('order_id')->unsigned();
          $table->bigInteger('pickup_id')->unsigned();
          $table->date('date');

          $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
          $table->foreign('pickup_id')->references('id')->on('pickups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_pickups');
    }
}
