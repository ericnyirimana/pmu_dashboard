<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('menu_sections')->insert([
          'created_at' => Carbon::now(),
      ]);

      DB::table('menu_section_translations')->insert([
          'name' => 'Primo',
          'code' => 'it',
          'menu_section_id' => 1
      ]);
      DB::table('menu_section_translations')->insert([
          'name' => 'Main Course',
          'code' => 'en',
          'menu_section_id' => 1
      ]);

      DB::table('menu_sections')->insert([
          'created_at' => Carbon::now(),
      ]);

      DB::table('menu_section_translations')->insert([
          'name' => 'Secondo',
          'code' => 'it',
          'menu_section_id' => 2
      ]);
      DB::table('menu_section_translations')->insert([
          'name' => 'Side Dish',
          'code' => 'en',
          'menu_section_id' => 2
      ]);
    }
}
