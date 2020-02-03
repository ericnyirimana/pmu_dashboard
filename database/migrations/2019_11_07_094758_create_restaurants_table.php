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
            $table->uuid('identifier')->index();
            $table->bigInteger('brand_id')->unsigned();
            $table->string('name');
            $table->string('merchant_stripe')->nullable();
            $table->string('address')->nullable();
            $table->string('coordinates', 40)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
