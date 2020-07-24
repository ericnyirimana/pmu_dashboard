<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnumPaymentsStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `payments` CHANGE `status` `status` enum('PENDING','DONE','ERROR','CANCELED');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `payments` CHANGE `status` `status` enum('PENDING','DONE','ERROR');");
    }
}
