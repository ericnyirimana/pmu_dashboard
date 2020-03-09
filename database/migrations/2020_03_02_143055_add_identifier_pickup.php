<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdentifierPickup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->uuid('identifier')->index();
        });

        Schema::table('pickup_offers', function (Blueprint $table) {
            $table->dropColumn('identifier');
        });

        Schema::table('pickup_subscriptions', function (Blueprint $table) {
            $table->dropColumn('identifier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->dropColumn('identifier');
        });
    }
}
