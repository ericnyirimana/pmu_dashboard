<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('identifier');
            $table->integer('type_id')->unsigned();
            $table->bigInteger('restaurant_id')->unsigned();
            $table->bigInteger('menu_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();

            $table->decimal('price', 5, 2)->nullable();
            $table->smallInteger('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('section_id')->references('id')->on('sections');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
