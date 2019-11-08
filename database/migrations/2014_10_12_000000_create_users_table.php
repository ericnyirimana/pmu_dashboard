<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('last_name')->nullable();
          $table->string('email')->unique()->notNullable();
          $table->string('password');
          $table->rememberToken('token');
          $table->string('phone', 20)->nullable();
          $table->string('profile_image')->nullable();
          $table->boolean('accept_terms_and_conditions')->default(false);
          $table->boolean('accept_marketing')->default(false);
          $table->boolean('accept_privacy_policy')->default(false);
          $table->timestamps();
          $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
