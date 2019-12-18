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

        // Sorbillo - id: 1

      DB::table('restaurants')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'Pizzeria Gino Sorbillo',
          'location' => 'Milano',
          'brand_id' => '1'
      ]);

      DB::table('restaurant_translations')->insert([
          'description' => 'Pizzeria Gino Sorbillo',
          'info' => '',
          'restaurant_id' => '1',
          'code'  => 'it'
      ]);

      DB::table('restaurant_translations')->insert([
          'description' => 'Pizzeria Gino Sorbillo',
          'info' => '',
          'restaurant_id' => '1',
          'code'  => 'en'
      ]);

        DB::table('opening_hours')->insert([
            'restaurant_id' => 1,
            'day_of_week' => 'monday',
            'hour_from' => '11:00',
            'hour_to'  => '15:00'
        ]);
        DB::table('opening_hours')->insert([
            'restaurant_id' => 1,
            'day_of_week' => 'monday',
            'hour_from' => '20:00',
            'hour_to'  => '23:00'
        ]);
        DB::table('opening_hours')->insert([
            'restaurant_id' => 1,
            'day_of_week' => 'tuesday',
            'hour_from' => '11:00',
            'hour_to'  => '20:00'
        ]);


        // Baobab - id: 2

      DB::table('restaurants')->insert([
          'identifier'  => (string) Str::uuid(),
          'name' => 'Baobab',
          'location' => 'Milano',
          'brand_id' => '3'
      ]);

      DB::table('restaurant_translations')->insert([
          'description' => 'Baobab',
          'info' => '',
          'restaurant_id' => '2',
          'code'  => 'it'
      ]);
      DB::table('restaurant_translations')->insert([
          'description' => 'Baobab',
          'info' => '',
          'restaurant_id' => '2',
          'code'  => 'en'
      ]);

      DB::table('opening_hours')->insert([
          'restaurant_id' => 2,
          'day_of_week' => 'monday',
          'hour_from' => '11:00',
          'hour_to'  => '15:00'
      ]);
      DB::table('opening_hours')->insert([
          'restaurant_id' => 2,
          'day_of_week' => 'monday',
          'hour_from' => '20:00',
          'hour_to'  => '23:00'
      ]);
      DB::table('opening_hours')->insert([
          'restaurant_id' => 2,
          'day_of_week' => 'tuesday',
          'hour_from' => '11:00',
          'hour_to'  => '20:00'
      ]);


        // Sushi fusion - id: 3

        DB::table('restaurants')->insert([
            'identifier'  => (string) Str::uuid(),
            'name' => 'Sushi fusion',
            'location' => 'Milano',
            'brand_id' => '3'
        ]);

        DB::table('restaurant_translations')->insert([
            'description' => 'Sushi fusion',
            'info' => '',
            'restaurant_id' => '3',
            'code'  => 'it'
        ]);
        DB::table('restaurant_translations')->insert([
            'description' => 'Sushi fusion',
            'info' => '',
            'restaurant_id' => '3',
            'code'  => 'en'
        ]);

        DB::table('opening_hours')->insert([
            'restaurant_id' => 3,
            'day_of_week' => 'monday',
            'hour_from' => '11:00',
            'hour_to'  => '15:00'
        ]);
        DB::table('opening_hours')->insert([
            'restaurant_id' => 3,
            'day_of_week' => 'monday',
            'hour_from' => '20:00',
            'hour_to'  => '23:00'
        ]);
        DB::table('opening_hours')->insert([
            'restaurant_id' => 3,
            'day_of_week' => 'tuesday',
            'hour_from' => '11:00',
            'hour_to'  => '20:00'
        ]);

        // Testone - id: 4

        DB::table('restaurants')->insert([
            'identifier'  => (string) Str::uuid(),
            'name' => 'Testone',
            'location' => 'Milano',
            'brand_id' => '2'
        ]);

        DB::table('restaurant_translations')->insert([
            'description' => 'Testone',
            'info' => '',
            'restaurant_id' => '4',
            'code'  => 'it'
        ]);
        DB::table('restaurant_translations')->insert([
            'description' => 'Sushi fusion',
            'info' => '',
            'restaurant_id' => '4',
            'code'  => 'en'
        ]);

        DB::table('opening_hours')->insert([
            'restaurant_id' => 4,
            'day_of_week' => 'monday',
            'hour_from' => '11:00',
            'hour_to'  => '15:00'
        ]);
        DB::table('opening_hours')->insert([
            'restaurant_id' => 4,
            'day_of_week' => 'monday',
            'hour_from' => '20:00',
            'hour_to'  => '23:00'
        ]);
        DB::table('opening_hours')->insert([
            'restaurant_id' => 4,
            'day_of_week' => 'tuesday',
            'hour_from' => '11:00',
            'hour_to'  => '20:00'
        ]);
    }
}
