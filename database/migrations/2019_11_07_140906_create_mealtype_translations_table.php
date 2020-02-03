<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealtypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mealtype_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mealtype_id')->unsigned();
            $table->string('name');
            $table->string('code', 2);
            $table->timestamps();

            $table->foreign('mealtype_id')->references('id')->on('mealtypes')->onDelete('cascade');
            $table->foreign('code')->references('code')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mealtype_translations');
    }
}
