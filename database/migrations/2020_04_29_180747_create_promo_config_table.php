<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('identifier')->index();
            $table->bigInteger('promo_id')->unsigned();
            $table->enum('discount_type', ['PERCENT', 'AMOUNT']);
            $table->decimal('discount_percent_off', 16, 2)->nullable();
            $table->decimal('discount_amount_off ', 16, 2)->nullable();
            $table->timestamp('start_date');
            $table->timestamp('expiration_date');
            $table->bigInteger('promo_validation_id')->unsigned();
            $table->decimal('pmu_fee', 5, 2);
            $table->integer('quantity');
            $table->integer('max_usage_for_user');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('promo_id')->references('id')->on('promo');
            $table->foreign('promo_validation_id')->references('id')->on('promo_validation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_config');
    }
}
