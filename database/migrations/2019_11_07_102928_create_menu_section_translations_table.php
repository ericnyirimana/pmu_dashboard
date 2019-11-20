<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->bigInteger('section_id')->unsigned();
          $table->string('name');
          $table->string('code', 2);
          $table->timestamps();

          $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('section_translations');
    }
}
