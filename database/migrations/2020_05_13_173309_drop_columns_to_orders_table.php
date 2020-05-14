<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('restaurant_status');
            $table->dropColumn('restaurant_notes');
            $table->dropColumn('status');
            $table->dropColumn('pmu_fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('pmu_fee', 5, 2)->after('promo_code');
            $table->enum('status', ['PENDING', 'PAID', 'REJECTED', 'CLOSED'])
                ->default('PENDING')->after('pmu_fee');
            $table->enum('restaurant_status', ['PENDING', 'CANCELED', 'ACCEPTED', 'REJECTED'])
                ->default('PENDING')->after('pmu_fee');
            $table->longText('restaurant_notes')->nullable()->after('pmu_fee');
        });
    }
}
