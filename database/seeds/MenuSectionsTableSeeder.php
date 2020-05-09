<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MenuSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ######## MENU 1 #########
        // Pizze - id: 1

      DB::table('menu_sections')->insert([
          'type'    => 'Dish',
          'identifier'  => (string) Str::uuid(),
          'created_at' => Carbon::now(),
          'menu_id' => 1,
      ]);

      DB::table('menu_section_translations')->insert([
          'name' => 'Pizza',
          'code' => 'it',
          'menu_section_id' => 1
      ]);
      DB::table('menu_section_translations')->insert([
          'name' => 'Pizza',
          'code' => 'en',
          'menu_section_id' => 1
      ]);

        // Bibita - id: 2

        DB::table('menu_sections')->insert([
            'type'    => 'Drink',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 1,
        ]);

        DB::table('menu_section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'it',
            'menu_section_id' => 2
        ]);
        DB::table('menu_section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'en',
            'menu_section_id' => 2
        ]);

        ######## MENU 2 #########
        // Hamburger - id: 3

      DB::table('menu_sections')->insert([
          'type'    => 'Dish',
          'identifier'  => (string) Str::uuid(),
          'created_at' => Carbon::now(),
          'menu_id' => 2,
      ]);

      DB::table('menu_section_translations')->insert([
          'name' => 'Hamburger',
          'code' => 'it',
          'menu_section_id' => 3
      ]);
      DB::table('menu_section_translations')->insert([
          'name' => 'Hamburger',
          'code' => 'en',
          'menu_section_id' => 3
      ]);

        // Bibita - id: 4

        DB::table('menu_sections')->insert([
            'type'    => 'Drink',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 2,
        ]);

        DB::table('menu_section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'it',
            'menu_section_id' => 4
        ]);
        DB::table('menu_section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'en',
            'menu_section_id' => 4
        ]);

        ######## MENU 3 #########
          // Uramaki - id: 5

        DB::table('menu_sections')->insert([
            'type'    => 'Dish',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 3,
        ]);

        DB::table('menu_section_translations')->insert([
            'name' => 'Uramaki',
            'code' => 'it',
            'menu_section_id' => 5
        ]);
        DB::table('menu_section_translations')->insert([
            'name' => 'Uramaki',
            'code' => 'en',
            'menu_section_id' => 5
        ]);

          // Bibita - id: 6

          DB::table('menu_sections')->insert([
              'type'    => 'Drink',
              'identifier'  => (string) Str::uuid(),
              'created_at' => Carbon::now(),
              'menu_id' => 3,
          ]);

          DB::table('menu_section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'it',
              'menu_section_id' => 6
          ]);
          DB::table('menu_section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'en',
              'menu_section_id' => 6
          ]);


        ######## MENU 4 #########
          // Pasta - id: 7

        DB::table('menu_sections')->insert([
            'type'    => 'Dish',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 4,
        ]);

        DB::table('menu_section_translations')->insert([
            'name' => 'Pasta',
            'code' => 'it',
            'menu_section_id' => 7
        ]);
        DB::table('menu_section_translations')->insert([
            'name' => 'Pasta',
            'code' => 'en',
            'menu_section_id' => 7
        ]);

          // Bibita - id: 8

          DB::table('menu_sections')->insert([
              'type'    => 'Drink',
              'identifier'  => (string) Str::uuid(),
              'created_at' => Carbon::now(),
              'menu_id' => 4,
          ]);

          DB::table('menu_section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'it',
              'menu_section_id' => 8
          ]);
          DB::table('menu_section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'en',
              'menu_section_id' => 8
          ]);
    }
}
