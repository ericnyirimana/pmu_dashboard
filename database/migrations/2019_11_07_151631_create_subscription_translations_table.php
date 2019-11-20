<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_translations', function (Blueprint $table) {

          $table->bigIncrements('id');
          $table->bigInteger('subscription_id')->unsigned();
          $table->string('description');
          $table->string('code', 2);
          $table->timestamps();

          $table->foreign('code')->references('code')->on('languages');
          $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_translations');
    }
}
