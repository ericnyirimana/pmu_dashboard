<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcasePickUpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcase_pick_up', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('showcase_id')->unsigned();
          $table->bigInteger('pick_up_id')->unsigned();
          $table->timestamps();

          $table->foreign('showcase_id')->references('id')->on('showcases')->onDelete('cascade');
          $table->foreign('pick_up_id')->references('id')->on('pick_ups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showcase_pick_up');
    }
}
