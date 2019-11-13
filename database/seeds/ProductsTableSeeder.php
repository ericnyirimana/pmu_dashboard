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
          'name' => 'Carbonara',
          'description' => 'Spaghetti alla Carbonara',
          'ingredients' => 'spaghetti, bacon, uove',
          'allergens' => 'uova',
          'code' => 'it'
      ]);

      DB::table('product_translations')->insert([
          'product_id' => 1,
          'name' => 'Carbonara',
          'description' => 'Carbonara\'s Spaghetti',
          'ingredients' => 'spaghetti, bacon, eggs',
          'allergens' => 'egg',
          'code' => 'en'
      ]);

      DB::table('product_category')->insert([
          'product_id' => 1,
          'category_id' => 1,
      ]);

      DB::table('product_category')->insert([
          'product_id' => 1,
          'category_id' => 2,
      ]);


      DB::table('products')->insert([
          'identifier'  => (string) Str::uuid(),
          'type_id' => 2,
          'restaurant_id' => 1,
          'section_id' => 2,
          'menu_id' => 1,
          'price' => '5',
          'status' => 1,
      ]);

      DB::table('product_translations')->insert([
          'product_id' => 2,
          'name' => 'Gelato',
          'description' => 'Gelato di cioccolato',
          'ingredients' => 'latte, cioccolato, fredo',
          'allergens' => 'laticini',
          'code' => 'it'
      ]);

      DB::table('product_translations')->insert([
          'product_id' => 2,
          'name' => 'Icecream',
          'description' => 'Chocolate Icecream',
          'ingredients' => 'Milk, chocolate, cold',
          'allergens' => 'milkitici',
          'code' => 'en'
      ]);

      DB::table('product_category')->insert([
          'product_id' => 2,
          'category_id' => 2,
      ]);
    }
}
