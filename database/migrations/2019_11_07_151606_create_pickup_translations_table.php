<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pickup_id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('code', 2);
            $table->timestamps();

            $table->foreign('code')->references('code')->on('languages');
            $table->foreign('pickup_id')->references('id')->on('pickups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickup_translations');
    }
}
