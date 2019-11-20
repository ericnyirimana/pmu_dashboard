<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_ups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('identifier');
            $table->integer('pu_type_id')->unsigned();
            $table->bigInteger('pu_time_slot_id')->unsigned();
            $table->bigInteger('restaurant_id')->unsigned();
            $table->string('name');
            $table->string('cover_image');
            $table->integer('quantity');
            $table->decimal('price', 5, 2);
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('pu_type_id')->references('id')->on('pu_types');
            $table->foreign('pu_time_slot_id')->references('id')->on('pu_time_slots');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pick_ups');
    }
}
