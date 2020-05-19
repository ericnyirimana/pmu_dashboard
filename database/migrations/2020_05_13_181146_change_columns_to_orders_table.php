<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToOrdersTable extends Migration
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
            $table->renameColumn('tax_amount', 'vat_tax');
            $table->enum('status', ['PENDING', 'COMPLETED', 'REJECTED', 'PAID', 'ERROR'])
                ->default('PENDING')->after('promo_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum',
            'string');
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('vat_tax', 'tax_amount');
            $table->dropColumn('status');
        });
    }
}
