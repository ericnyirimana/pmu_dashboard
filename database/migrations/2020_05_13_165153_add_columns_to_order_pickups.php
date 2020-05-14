<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrderPickups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_pickups', function (Blueprint $table) {

            $table->decimal('fee', 5, 2)->after('is_coming');
            $table->string('promo_code')->nullable()->after('fee');
            $table->decimal('pmu_commission', 16, 2)->default(0)->after('promo_code');
            $table->decimal('restaurant_commission', 16, 2)->default(0)->after('pmu_commission');
            $table->decimal('total_amount', 16, 2)->after('restaurant_commission');
            $table->decimal('vat_tax', 5, 2)->after('total_amount');
            $table->enum('restaurant_status', ['PENDING', 'ACCEPTED', 'CANCELED'])
                ->default('PENDING')->after('vat_tax');
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
        Schema::table('order_pickups', function (Blueprint $table) {
            $table->dropColumn('restaurant_notes');
            $table->dropColumn('restaurant_status');
            $table->dropColumn('vat_tax');
            $table->dropColumn('total_amount');
            $table->dropColumn('restaurant_commission');
            $table->dropColumn('pmu_commission');
            $table->dropColumn('promo_code');
            $table->dropColumn('fee');
        });
    }
}
