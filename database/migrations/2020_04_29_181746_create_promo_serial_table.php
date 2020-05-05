<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoSerialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_serial', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('identifier')->index();
            $table->bigInteger('promo_id')->unsigned();
            $table->bigInteger('promo_subset_id')->unsigned();
            $table->enum('scope', ['TEST', 'PRODUCTION']);
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('promo_subset_id')->references('id')->on('promo_subset');
            $table->foreign('promo_id')->references('id')->on('promo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_serial');
    }
}
