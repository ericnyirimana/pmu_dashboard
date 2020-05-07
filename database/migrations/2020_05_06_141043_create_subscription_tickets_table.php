<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pickup_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->integer('quantity')->default(0);
            $table->integer('closed')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pickup_id')->references('id')->on('pickups')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_tickets');
    }
}
