<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('restaurants')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'McRonalds Viale Certosa',
          'location' => 'Milano',
          'brand_id' => '1'
      ]);

      DB::table('restaurant_translations')->insert([
          'description' => 'McRonaldo della Certosa',
          'info' => '',
          'restaurant_id' => '1',
          'code'  => 'it'
      ]);
      DB::table('restaurant_translations')->insert([
          'description' => 'Certosa\'s McRonald',
          'info' => '',
          'restaurant_id' => '1',
          'code'  => 'en'
      ]);

      DB::table('restaurants')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'Le Taglia tele',
          'location' => 'Milano',
          'brand_id' => '3'
      ]);

      DB::table('restaurant_translations')->insert([
          'description' => 'Le Taglia tele',
          'info' => '',
          'restaurant_id' => '2',
          'code'  => 'it'
      ]);
      DB::table('restaurant_translations')->insert([
          'description' => 'The Cut web',
          'info' => '',
          'restaurant_id' => '2',
          'code'  => 'en'
      ]);
    }
}
