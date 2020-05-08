<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColoumsInOrderPickups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_pickups', function (Blueprint $table) {
            $table->renameColumn('offer_price ', 'offer_price');
            $table->renameColumn('discounted_price ', 'discounted_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_pickups', function (Blueprint $table) {
            $table->renameColumn('offer_price', 'offer_price ');
            $table->renameColumn('discounted_price', 'discounted_price ');
        });
    }
}
