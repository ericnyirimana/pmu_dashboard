<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToOrderPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_pickups', function (Blueprint $table) {
            $table->softDeletes()->after('is_coming');
            $table->decimal('offer_price ', 16, 2)->after('is_coming');
            $table->decimal('discounted_price ', 16, 2)->default(0)->after('is_coming');
            $table->timestamps();

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
            /*
            $table->dropColumn('discounted_price');
            $table->dropColumn('offer_price');
            $table->dropColumn('is_coming');
            $table->dropTimestamps();
            */
        });
    }
}
