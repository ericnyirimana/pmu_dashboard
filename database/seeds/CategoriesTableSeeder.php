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
          'name' => 'Food Category',
      ]);

      DB::table('category_types')->insert([
          'name' => 'Dietary',
      ]);

      DB::table('category_types')->insert([
          'name' => 'Allergens',
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


        // Crustaceans - id: 7
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '3',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Crustacei',
            'description' => 'Cosa dal mare',
            'category_id' => '7',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Crustaceans',
            'description' => 'Ocean\'s crust',
            'category_id' => '7',
            'code'  => 'en'
        ]);

        // Eggs - id: 8
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '3',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Uove',
            'description' => '',
            'category_id' => '8',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Eggs',
            'description' => '',
            'category_id' => '8',
            'code'  => 'en'
        ]);

        // Peanuts - id: 9
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '3',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Nocci',
            'description' => '',
            'category_id' => '9',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Peanuts',
            'description' => '',
            'category_id' => '9',
            'code'  => 'en'
        ]);

        // Milk - id: 10
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '3',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Latte',
            'description' => '',
            'category_id' => '10',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Milk',
            'description' => '',
            'category_id' => '10',
            'code'  => 'en'
        ]);

        // Kosher - id: 11
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '2',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Kosher',
            'description' => '',
            'category_id' => '11',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Kosher',
            'description' => '',
            'category_id' => '11',
            'code'  => 'en'
        ]);

        // Halal - id: 12
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '2',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Halal',
            'description' => '',
            'category_id' => '12',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Halal',
            'description' => '',
            'category_id' => '12',
            'code'  => 'en'
        ]);

        // Gluten free - id: 13
        DB::table('categories')->insert([
            'identifier'  => (string) Str::uuid(),
            'category_type_id' => '2',
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Gluten libero',
            'description' => '',
            'category_id' => '13',
            'code'  => 'it'
        ]);

        DB::table('category_translations')->insert([
            'name' => 'Gluten free',
            'description' => '',
            'category_id' => '13',
            'code'  => 'en'
        ]);

    }
}
