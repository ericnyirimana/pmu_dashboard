<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColoumsInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum',
            'string');
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('total_commission ', 'total_commission');
            $table->renameColumn('subtotal_amount ', 'subtotal_amount');
            $table->renameColumn('discounted_price ', 'discounted_price');
            $table->renameColumn('total_amount ', 'total_amount');
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
            $table->renameColumn('total_commission', 'total_commission ');
            $table->renameColumn('subtotal_amount', 'subtotal_amount ');
            $table->renameColumn('discounted_price', 'discounted_price ');
            $table->renameColumn('total_amount', 'total_amount ');
        });
    }
}
