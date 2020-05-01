<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('payment_id')->unsigned()->after('user_id');
            $table->bigInteger('promo_serial_used_id')->unsigned()->nullable()->after('user_id');
            $table->string('promo_code')->nullable()->after('promo_serial_used_id');

            $table->decimal('pmu_fee', 5, 2)->after('promo_code');
            $table->decimal('total_commission ', 16, 2)->after('pmu_fee');

            $table->decimal('subtotal_amount ', 16, 2)->after('pmu_fee');
            $table->decimal('discounted_price ', 16, 2)->default(0)->after('pmu_fee');
            $table->decimal('tax_amount', 5, 2)->after('pmu_fee');
            $table->decimal('total_amount ', 16, 2)->after('pmu_fee');
            $table->enum('status', ['PENDING', 'PAID', 'REJECTED', 'CLOSED'])
                ->default('PENDING')->after('pmu_fee');
            $table->enum('restaurant_status', ['PENDING', 'CANCELED', 'ACCEPTED', 'REJECTED'])
                ->default('PENDING')->after('pmu_fee');
            $table->longText('restaurant_notes')->nullable()->after('pmu_fee');

            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('promo_serial_used_id')->references('id')->on('promo_serial_used');
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
            /*
            $table->dropColumn('payment_id');
            $table->dropColumn('promo_serial_used_id');
            $table->dropColumn('promo_code');
            $table->dropColumn('pmu_fee');
            $table->dropColumn('total_commission');
            $table->dropColumn('subtotal_amount');
            $table->dropColumn('discounted_price');
            $table->dropColumn('tax_amount');
            $table->dropColumn('total_amount');
            $table->dropColumn('restaurant_status');
            $table->dropColumn('restaurant_notes');
            */
        });
    }
}
