<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pickup_id')->unsigned();
            $table->string('type_offer'); //single, combo
            $table->integer('quantity_offer')->default(1);
            $table->integer('quantity_remain')->default(1);
            $table->integer('price'); // will only accepts 7 or 14
            $table->integer('validate_days');
            $table->integer('quantity_per_subscription')->default(1);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('pickup_subscriptions');
    }
}
