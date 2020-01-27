<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsMenuSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_menu_sections', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('product_id')->unsigned();
          $table->bigInteger('menu_section_id')->unsigned();
          $table->timestamps();

          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          $table->foreign('menu_section_id')->references('id')->on('menu_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_menu_sections');
    }
}
