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

    // Pizza - id: 1
    
      DB::table('categories')->insert([
          'identifier'  => (string) Str::uuid(),
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

    
    // Hamburger - id: 2

    DB::table('categories')->insert([
        'identifier'  => (string) Str::uuid(),
        'category_type_id' => '1',
    ]);

    DB::table('category_translations')->insert([
        'name' => 'Hamburger',
        'description' => '',
        'category_id' => '2',
        'code'  => 'it'
    ]);

    DB::table('category_translations')->insert([
        'name' => 'Hamburger',
        'description' => '',
        'category_id' => '2',
        'code'  => 'en'
    ]);
        
        // Pasta - id: 3
        
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '1',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Pasta',
            'description' => '',
            'category_id' => '3',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Pasta',
            'description' => '',
            'category_id' => '3',
            'code'  => 'en'
        ]);
        
        // Sushi - id: 4
        
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '1',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Sushi',
            'description' => '',
            'category_id' => '4',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Sushi',
            'description' => '',
            'category_id' => '4',
            'code'  => 'en'
        ]);
        
        // Vegano - id: 5

        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '2',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Vegano',
            'description' => '',
            'category_id' => '5',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Vegan',
            'description' => '',
            'category_id' => '5',
            'code'  => 'en'
        ]);

        // Drink - id: 6

        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '1',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Bevande',
            'description' => '',
            'category_id' => '6',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Drink',
            'description' => '',
            'category_id' => '6',
            'code'  => 'en'
        ]);
    }
}
