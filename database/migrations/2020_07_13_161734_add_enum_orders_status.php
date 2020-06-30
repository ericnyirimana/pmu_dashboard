<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnumOrdersStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `orders` CHANGE `status` `status` enum('PENDING','COMPLETED','REJECTED','PAID','ERROR','CANCELED');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `orders` CHANGE `status` `status` enum('PENDING','COMPLETED','REJECTED','PAID','ERROR');");
    }
}
