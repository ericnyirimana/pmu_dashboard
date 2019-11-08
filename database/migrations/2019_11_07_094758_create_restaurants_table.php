<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('identifier');
            $table->bigInteger('brand_id')->unsigned();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->string('merchant_stripe')->nullable();
            $table->string('location')->nullable();
            $table->string('coordinates', 40)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
