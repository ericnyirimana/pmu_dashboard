<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_access', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('operator_id')->unsigned();
            $table->morphs('accessable');

            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operator_access');
    }
}
