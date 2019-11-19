<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PickUpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('pu_types')->insert([
        'name' => 'Single'
      ]);

      DB::table('pu_types')->insert([
        'name' => 'Combo'
      ]);

      DB::table('pu_types')->insert([
        'name' => 'Subscription'
      ]);

      DB::table('meal_categories')->insert([
        'name' => 'Uno',
      ]);

      DB::table('meal_categories')->insert([
        'name' => 'Duo',
      ]);

      DB::table('pu_time_slots')->insert([
        'identifier'  => (string) Str::uuid(),
        'meal_category_id' => 1,
        'time_ini' => '10:00',
        'time_end' => '20:00',
        'main'  => '1'
      ]);

      DB::table('pu_time_slots')->insert([
        'identifier'  => (string) Str::uuid(),
        'meal_category_id' => 2,
        'time_ini' => '10:00',
        'time_end' => '20:00',
        'main'  => '1'
      ]);

      DB::table('pick_ups')->insert([
          'identifier'  => (string) Str::uuid(),
          'pu_type_id' => 1,
          'pu_time_slot_id' => 1,
          'name' => 'Menu principale',
          'cover_image' => 'url_image.jpg',
          'quantity' => 1,
          'price' => 7,
          'status' => 1
      ]);


      DB::table('pick_up_product')->insert([
        'product_id' => 1,
        'pick_up_id' => 1,
      ]);

      DB::table('pick_up_product')->insert([
        'product_id' => 2,
        'pick_up_id' => 1,
      ]);

      DB::table('restaurant_pick_up')->insert([
        'restaurant_id' => 1,
        'pick_up_id' => 1,
      ]);
    }
}
