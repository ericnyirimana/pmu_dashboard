<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTicketProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_ticket_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('subscription_ticket_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('subscription_ticket_id')->references('id')->on('subscription_tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_ticket_products');
    }
}
