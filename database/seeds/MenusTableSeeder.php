<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('menus')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'Cheeseburger Menu',
          'restaurant_id' => 1,

      ]);

      DB::table('menus')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'Desert Menu',
          'restaurant_id' => 1,

      ]);


    }
}
