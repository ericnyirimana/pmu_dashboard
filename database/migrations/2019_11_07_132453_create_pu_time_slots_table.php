<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pu_time_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('meal_category_id')->unsigned();
            $table->string('time_ini', 5);
            $table->string('time_end', 5);
            $table->smallInteger('main');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('meal_category_id')->references('id')->on('meal_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pu_time_slots');
    }
}
