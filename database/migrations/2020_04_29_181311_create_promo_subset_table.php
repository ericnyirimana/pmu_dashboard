<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoSubsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_subset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('identifier')->index();
            $table->bigInteger('promo_id')->unsigned();
            $table->boolean('is_custom_serial')->default(false);
            $table->enum('serial_type', ['ALPHANUMERIC', 'NUMERIC']);
            $table->integer('serial_length')->nullable();
            $table->string('serial_prefix')->nullable();
            $table->string('custom_serial')->nullable();
            $table->integer('quantity');
            $table->string('short_identifier ', 3)->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('promo_subset');
    }
}
