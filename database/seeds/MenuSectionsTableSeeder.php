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

      DB::table('sections')->insert([
          'type'    => 'food',
          'identifier'  => (string) Str::uuid(),
          'created_at' => Carbon::now(),
          'menu_id' => 1,
      ]);

      DB::table('section_translations')->insert([
          'name' => 'Pizza',
          'code' => 'it',
          'section_id' => 1
      ]);
      DB::table('section_translations')->insert([
          'name' => 'Pizza',
          'code' => 'en',
          'section_id' => 1
      ]);

        // Bibita - id: 2

        DB::table('sections')->insert([
            'type'    => 'drink',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 1,
        ]);

        DB::table('section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'it',
            'section_id' => 2
        ]);
        DB::table('section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'en',
            'section_id' => 2
        ]);

        ######## MENU 2 #########
        // Hamburger - id: 3

      DB::table('sections')->insert([
          'type'    => 'food',
          'identifier'  => (string) Str::uuid(),
          'created_at' => Carbon::now(),
          'menu_id' => 2,
      ]);

      DB::table('section_translations')->insert([
          'name' => 'Hamburger',
          'code' => 'it',
          'section_id' => 3
      ]);
      DB::table('section_translations')->insert([
          'name' => 'Hamburger',
          'code' => 'en',
          'section_id' => 3
      ]);

        // Bibita - id: 4

        DB::table('sections')->insert([
            'type'    => 'drink',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 2,
        ]);

        DB::table('section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'it',
            'section_id' => 4
        ]);
        DB::table('section_translations')->insert([
            'name' => 'Bibita',
            'code' => 'en',
            'section_id' => 4
        ]);

        ######## MENU 3 #########
          // Uramaki - id: 5

        DB::table('sections')->insert([
            'type'    => 'food',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 3,
        ]);

        DB::table('section_translations')->insert([
            'name' => 'Uramaki',
            'code' => 'it',
            'section_id' => 5
        ]);
        DB::table('section_translations')->insert([
            'name' => 'Uramaki',
            'code' => 'en',
            'section_id' => 5
        ]);

          // Bibita - id: 6

          DB::table('sections')->insert([
              'type'    => 'drink',
              'identifier'  => (string) Str::uuid(),
              'created_at' => Carbon::now(),
              'menu_id' => 3,
          ]);

          DB::table('section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'it',
              'section_id' => 6
          ]);
          DB::table('section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'en',
              'section_id' => 6
          ]);


        ######## MENU 4 #########
          // Pasta - id: 7

        DB::table('sections')->insert([
            'type'    => 'food',
            'identifier'  => (string) Str::uuid(),
            'created_at' => Carbon::now(),
            'menu_id' => 4,
        ]);

        DB::table('section_translations')->insert([
            'name' => 'Pasta',
            'code' => 'it',
            'section_id' => 7
        ]);
        DB::table('section_translations')->insert([
            'name' => 'Pasta',
            'code' => 'en',
            'section_id' => 7
        ]);

          // Bibita - id: 8

          DB::table('sections')->insert([
              'type'    => 'drink',
              'identifier'  => (string) Str::uuid(),
              'created_at' => Carbon::now(),
              'menu_id' => 4,
          ]);

          DB::table('section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'it',
              'section_id' => 8
          ]);
          DB::table('section_translations')->insert([
              'name' => 'Bibita',
              'code' => 'en',
              'section_id' => 8
          ]);
    }
}
