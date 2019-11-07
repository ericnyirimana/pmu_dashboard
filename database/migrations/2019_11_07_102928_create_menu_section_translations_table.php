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
        Schema::create('menu_section_translations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('menu_section_id')->unsigned();
          $table->string('name');
          $table->string('code', 2);
          $table->timestamps();

          $table->foreign('menu_section_id')->references('id')->on('menu_sections');
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
        Schema::dropIfExists('menu_section_translations');
    }
}
