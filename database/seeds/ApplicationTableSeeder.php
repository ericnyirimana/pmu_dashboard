<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application')->insert([
            'key' => 'SUBSCRIPTION_DISCOUNT_PERCENTAGE',
            'value' => '14.28'
        ]);
        DB::table('application')->insert([
            'key' => 'SUBSCRIPTION_FEE',
            'value' => '28.58'
        ]);
        DB::table('application')->insert([
            'key' => 'IVA',
            'value' => '10'
        ]);
    }

}
