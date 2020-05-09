<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcaseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcase_translations', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('showcase_id')->unsigned();
          $table->string('name');
          $table->string('code', 2);
          $table->timestamps();

          $table->foreign('code')->references('code')->on('languages');
          $table->foreign('showcase_id')->references('id')->on('showcases')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showcase_translations');
    }
}
