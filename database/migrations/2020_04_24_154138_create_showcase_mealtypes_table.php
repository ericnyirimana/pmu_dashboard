<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcaseMealtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcase_mealtypes', function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('showcase_id')->unsigned();
            $table->integer('mealtype_id')->unsigned();

            $table->foreign('showcase_id')->references('id')->on('showcases')->onDelete('cascade');
            $table->foreign('mealtype_id')->references('id')->on('mealtypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showcase_mealtypes');
    }
}
