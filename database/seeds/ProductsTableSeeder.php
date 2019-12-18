<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('types')->insert([
          'name'  => 'Piatto',
      ]);
      DB::table('types')->insert([
          'name'  => 'Bevanda',
      ]);
       
        // Pizza Margherita - id: 1
        
      DB::table('products')->insert([
          'identifier'  => (string) Str::uuid(),
          'type_id' => 1,
          'restaurant_id' => 1,
          'section_id' => 1,
          'menu_id' => 1,
          'price' => '7',
          'status' => 1,
      ]);

      DB::table('product_translations')->insert([
          'product_id' => 1,
          'name' => 'Pizza Margherita',
          'description' => 'Mozzarella, olio, pomodoro',
          'ingredients' => 'Mozzarella, olio, pomodoro',
          'allergens' => '',
          'code' => 'it'
      ]);

      DB::table('product_translations')->insert([
          'product_id' => 1,
          'name' => 'Pizza Margherita',
          'description' => 'Mozzarella, oil, tomato',
          'ingredients' => 'Mozzarella, oil, tomato',
          'allergens' => '',
          'code' => 'en'
      ]);

      DB::table('product_category')->insert([
          'product_id' => 1,
          'category_id' => 1,
      ]);

        
        // Pizza salsiccia e friarielli - id: 2

      DB::table('products')->insert([
          'identifier'  => (string) Str::uuid(),
          'type_id' => 1,
          'restaurant_id' => 1,
          'section_id' => 1,
          'menu_id' => 1,
          'price' => '5',
          'status' => 1,
      ]);

      DB::table('product_translations')->insert([
          'product_id' => 2,
          'name' => 'Pizza salsiccia e friarielli',
          'description' => 'Salsiccia e friarielli',
          'ingredients' => 'Salsiccia e friarielli',
          'allergens' => '',
          'code' => 'it'
      ]);

      DB::table('product_translations')->insert([
          'product_id' => 2,
          'name' => 'Pizza salsiccia e friarielli',
          'description' => 'Salsiccia e friarielli',
          'ingredients' => 'Salsiccia e friarielli',
          'allergens' => '',
          'code' => 'en'
      ]);

      DB::table('product_category')->insert([
          'product_id' => 2,
          'category_id' => 1,
      ]);
        
        
        // Pizza crudo e rucola - id: 3

        DB::table('products')->insert([
            'identifier'  => (string) Str::uuid(),
            'type_id' => 1,
            'restaurant_id' => 1,
            'section_id' => 1,
            'menu_id' => 1,
            'price' => '5',
            'status' => 1,
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 3,
            'name' => 'Pizza crudo e rucola',
            'description' => 'Crudo e rucola',
            'ingredients' => 'Crudo e rucola',
            'allergens' => '',
            'code' => 'it'
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 3,
            'name' => 'Pizza crudo e rucola',
            'description' => 'Crudo e rucola',
            'ingredients' => 'Crudo e rucola',
            'allergens' => '',
            'code' => 'en'
        ]);

        DB::table('product_category')->insert([
            'product_id' => 3,
            'category_id' => 1,
        ]);
        
        
        // Hamburger - id: 4

        DB::table('products')->insert([
            'identifier'  => (string) Str::uuid(),
            'type_id' => 1,
            'restaurant_id' => 2,
            'section_id' => 3,
            'menu_id' => 2,
            'price' => '15',
            'status' => 1,
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 4,
            'name' => 'Hamburger, insalata e bacon',
            'description' => 'Hamburger, insalata e bacon',
            'ingredients' => 'Hamburger, insalata e bacon',
            'allergens' => '',
            'code' => 'it'
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 4,
            'name' => 'Hamburger, insalata e bacon',
            'description' => 'Hamburger, insalata e bacon',
            'ingredients' => 'Hamburger, insalata e bacon',
            'allergens' => '',
            'code' => 'en'
        ]);

        DB::table('product_category')->insert([
            'product_id' => 4,
            'category_id' => 2,
        ]);
        
        
        // Hamburger - id: 5

        DB::table('products')->insert([
            'identifier'  => (string) Str::uuid(),
            'type_id' => 1,
            'restaurant_id' => 2,
            'section_id' => 3,
            'menu_id' => 2,
            'price' => '15',
            'status' => 1,
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 5,
            'name' => 'Hamburger scamorza e melanzane',
            'description' => 'Hamburger scamorza e melanzane',
            'ingredients' => 'Hamburger scamorza e melanzane',
            'allergens' => '',
            'code' => 'it'
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 5,
            'name' => 'Hamburger scamorza e melanzane',
            'description' => 'Hamburger scamorza e melanzane',
            'ingredients' => 'Hamburger scamorza e melanzane',
            'allergens' => '',
            'code' => 'en'
        ]);

        DB::table('product_category')->insert([
            'product_id' => 5,
            'category_id' => 2,
        ]);
        
        
        // Pasta al sugo - id: 6

        DB::table('products')->insert([
            'identifier'  => (string) Str::uuid(),
            'type_id' => 1,
            'restaurant_id' => 4,
            'section_id' => 7,
            'menu_id' => 4,
            'price' => '7',
            'status' => 1,
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 6,
            'name' => 'Pasta al sugo',
            'description' => 'Sugo',
            'ingredients' => 'Sugo',
            'allergens' => '',
            'code' => 'it'
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 6,
            'name' => 'Pasta al sugo',
            'description' => 'Sugo',
            'ingredients' => 'Sugo',
            'allergens' => '',
            'code' => 'en'
        ]);

        DB::table('product_category')->insert([
            'product_id' => 6,
            'category_id' => 3,
        ]);
        
        
        // Salmon roll - id: 7

        DB::table('products')->insert([
            'identifier'  => (string) Str::uuid(),
            'type_id' => 1,
            'restaurant_id' => 3,
            'section_id' => 5,
            'menu_id' => 3,
            'price' => '9',
            'status' => 1,
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 7,
            'name' => 'Uramaki Salmon roll',
            'description' => 'Salmone e avocado',
            'ingredients' => 'Salmone e avocado',
            'allergens' => '',
            'code' => 'it'
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 7,
            'name' => 'Uramaki Salmon roll',
            'description' => 'Salmon',
            'ingredients' => 'Salmon',
            'allergens' => '',
            'code' => 'en'
        ]);

        DB::table('product_category')->insert([
            'product_id' => 7,
            'category_id' => 4,
        ]);
        
        
        ############ DRINK ###########
        
        // Coca cola - id: 8

        DB::table('products')->insert([
            'identifier'  => (string) Str::uuid(),
            'type_id' => 2,
            'restaurant_id' => 1,
            'section_id' => 2,
            'menu_id' => 1,
            'price' => '2.5',
            'status' => 1,
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 8,
            'name' => 'Coca cola',
            'description' => '',
            'ingredients' => '',
            'allergens' => '',
            'code' => 'it'
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 8,
            'name' => 'Coca cola',
            'description' => '',
            'ingredients' => '',
            'allergens' => '',
            'code' => 'en'
        ]);

        DB::table('product_category')->insert([
            'product_id' => 8,
            'category_id' => 6,
        ]);
        
        // Acqua - id: 9

        DB::table('products')->insert([
            'identifier'  => (string) Str::uuid(),
            'type_id' => 2,
            'restaurant_id' => 1,
            'section_id' => 2,
            'menu_id' => 1,
            'price' => '1.5',
            'status' => 1,
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 9,
            'name' => 'Acqua',
            'description' => '',
            'ingredients' => '',
            'allergens' => '',
            'code' => 'it'
        ]);

        DB::table('product_translations')->insert([
            'product_id' => 9,
            'name' => 'Water',
            'description' => '',
            'ingredients' => '',
            'allergens' => '',
            'code' => 'en'
        ]);

        DB::table('product_category')->insert([
            'product_id' => 9,
            'category_id' => 6,
        ]);
    }
}
