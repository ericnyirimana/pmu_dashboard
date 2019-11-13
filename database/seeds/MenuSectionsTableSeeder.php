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
      DB::table('sections')->insert([
          'identifier'  => (string) Str::uuid(),
          'created_at' => Carbon::now(),
          'menu_id' => 1,
      ]);

      DB::table('section_translations')->insert([
          'name' => 'Primo',
          'code' => 'it',
          'section_id' => 1
      ]);
      DB::table('section_translations')->insert([
          'name' => 'Main Course',
          'code' => 'en',
          'section_id' => 1
      ]);

      DB::table('sections')->insert([
          'identifier'  => (string) Str::uuid(),
          'created_at' => Carbon::now(),
          'menu_id' => 1,
      ]);

      DB::table('section_translations')->insert([
          'name' => 'Secondo',
          'code' => 'it',
          'section_id' => 2
      ]);
      DB::table('section_translations')->insert([
          'name' => 'Side Dish',
          'code' => 'en',
          'section_id' => 2
      ]);
    }
}
