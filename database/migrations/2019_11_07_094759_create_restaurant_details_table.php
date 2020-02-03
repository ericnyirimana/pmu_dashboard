<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('restaurant_id')->unsigned();
            $table->bigInteger('logo_media_id')->unsigned()->nullable();
            $table->string('billing_address')->nullable();
            $table->string('iva')->nullable();
            $table->string('iban')->nullable();
            $table->string('fee');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('logo_media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_details');
    }
}
