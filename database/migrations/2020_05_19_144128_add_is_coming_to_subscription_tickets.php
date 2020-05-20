<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsComingToSubscriptionTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_tickets', function (Blueprint $table) {
            $table->integer('is_coming')->default(0)->after('closed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_tickets', function (Blueprint $table) {
            $table->dropColumn('is_coming');
        });
    }
}
