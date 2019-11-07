<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('brands')->insert([
          'name' => 'McRonalds',
          'corporate_name' => 'McRonalds S.A.',
          'vat'   => '123456'
      ]);

      DB::table('brands')->insert([
          'name' => 'Robs',
          'corporate_name' => 'Robs Hamburger S.A.',
          'vat'   => '654321'
      ]);

      DB::table('brands')->insert([
          'name' => 'Le taglia tele',
          'corporate_name' => 'Ricardo Ferrara S.A.',
          'vat'   => '41635'
      ]);


    }
}
