<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnumToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `payments` CHANGE `payment_method_types` `payment_method_types` enum('CREDIT_CARD','PAYPAL','PROMO_CODE');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `payments` CHANGE `payment_method_types` `payment_method_types` enum('CREDIT_CARD','PAYPAL');");
    }
}
