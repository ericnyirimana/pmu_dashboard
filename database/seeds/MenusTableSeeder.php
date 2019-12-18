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

        ######## MENU 1 - Sorbillo #########
        
      DB::table('menus')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'Menu Sorbillo',
          'restaurant_id' => 1,
      ]);
        
        ######## MENU 2 - Baobab #########

      DB::table('menus')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'Menu Baobab',
          'restaurant_id' => 2,
      ]);

        ######## MENU 3 - Sushi fusion #########

        DB::table('menus')->insert([
            'identifier'  => (string) Str::uuid(),
            'name' => 'Menu Sushi fusion',
            'restaurant_id' => 3,
        ]);
        
        ######## MENU 4 - Testone #########

        DB::table('menus')->insert([
            'identifier'  => (string) Str::uuid(),
            'name' => 'Menu Testone',
            'restaurant_id' => 4,
        ]);
    }
}
