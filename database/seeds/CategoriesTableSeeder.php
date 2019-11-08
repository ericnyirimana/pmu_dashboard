<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      DB::table('category_types')->insert([
          'name' => 'FoodCategory',

      ]);

      DB::table('category_types')->insert([
          'name' => 'Diets',
      ]);

      DB::table('categories')->insert([
          'identifier'  => (string) Str::uuid(),
          'image' => '',
          'category_type_id' => '1',
      ]);

      DB::table('category_translations')->insert([
          'name' => 'Pizza',
          'description' => 'Pizza Italiana',
          'category_id' => '1',
          'code'  => 'it'
      ]);

      DB::table('category_translations')->insert([
          'name' => 'Pizza',
          'description' => 'Italian Pizza',
          'category_id' => '1',
          'code'  => 'en'
      ]);


      DB::table('categories')->insert([
          'identifier'  => (string) Str::uuid(),
          'image' => '',
          'category_type_id' => '2',
      ]);

      DB::table('category_translations')->insert([
          'name' => 'Gelato',
          'description' => '',
          'category_id' => '2',
          'code'  => 'it'
      ]);

      DB::table('category_translations')->insert([
          'name' => 'Icecream',
          'description' => '',
          'category_id' => '2',
          'code'  => 'en'
      ]);

    }
}
