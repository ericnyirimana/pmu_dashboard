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
            $table->uuid('identifier')->index();
            $table->decimal('price', 5, 2)->nullable();
            $table->bigInteger('section_id')->unsigned();
            $table->smallInteger('status');
            $table->integer('position')->default(1);
            $table->timestamps();
            $table->softDeletes();

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
