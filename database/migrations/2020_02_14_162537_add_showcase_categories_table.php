<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowcaseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('showcase_categories', function(Blueprint $table){
             $table->increments('id');
             $table->bigInteger('showcase_id')->unsigned();
             $table->integer('category_id')->unsigned();

             $table->foreign('showcase_id')->references('id')->on('showcases')->onDelete('cascade');
             $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::dropIfExists('showcase_categories');
     }
}
