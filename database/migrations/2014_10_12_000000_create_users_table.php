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
          $table->string('sub')->index();
          $table->string('email');
          $table->string('password');
          $table->string('profile_image')->nullable();
          $table->string('remember_token')->nullable();
          $table->text('profile')->nullable();
          $table->string('role',20)->default('CUSTOMER');
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
