<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSubscriptionTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_tickets', function (Blueprint $table) {
            $table->enum('restaurant_status', ['PENDING', 'ACCEPTED', 'CANCELED'])
                ->default('PENDING')->after('quantity');
            $table->longText('restaurant_notes')->nullable()->after('restaurant_status');
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
            $table->dropColumn('restaurant_status');
            $table->dropColumn('restaurant_notes');
        });
    }
}
