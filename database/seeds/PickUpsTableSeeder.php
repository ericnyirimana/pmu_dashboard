<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PickUpsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {



      DB::table('mealtypes')->insert([
        'name' => 'Pranzo',
      ]);

      DB::table('mealtypes')->insert([
        'name' => 'Cena',
      ]);

        // PickUp - TIME SLOT

      DB::table('pu_time_slots')->insert([
        'identifier'  => (string) Str::uuid(),
        'meal_category_id' => 1,
        'hour_ini' => '12:00',
        'hour_end' => '15:00',
        'main'  => '1'
      ]);

      DB::table('pu_time_slots')->insert([
        'identifier'  => (string) Str::uuid(),
        'meal_category_id' => 2,
        'hour_ini' => '18:00',
        'hour_end' => '22:00',
        'main'  => '1'
      ]);

        // PickUps

        ######## PICKUPS - Sorbillo #########

        // COMBO - Pizza + bibita

      DB::table('pickups')->insert([
          'identifier'  => (string) Str::uuid(),
          'pu_type_id' => 2,
          'pu_time_slot_id' => 1,
          'restaurant_id' => 1,
          'name' => 'Pizza a scelta + bibita a scelta',
          'cover_image' => 'https://i.ibb.co/GxFkNnb/Pizza-Margherita.jpg',
          'quantity' => 10,
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

        DB::table('pick_up_product')->insert([
          'product_id' => 3,
          'pick_up_id' => 1,
        ]);

        DB::table('pick_up_product')->insert([
          'product_id' => 8,
          'pick_up_id' => 1,
        ]);

        DB::table('pick_up_product')->insert([
          'product_id' => 9,
          'pick_up_id' => 1,
        ]);

        // Pizza a scelta

        DB::table('pickups')->insert([
            'identifier'  => (string) Str::uuid(),
            'pu_type_id' => 1,
            'pu_time_slot_id' => 2,
            'restaurant_id' => 1,
            'name' => 'Pizza a scelta',
            'cover_image' => 'https://i.ibb.co/YQ94RzM/Pizza-salsiccia-e-friarielli.jpg',
            'quantity' => 20,
            'price' => 7,
            'status' => 1
        ]);

        DB::table('pick_up_product')->insert([
          'product_id' => 1,
          'pick_up_id' => 2,
        ]);

        DB::table('pick_up_product')->insert([
          'product_id' => 2,
          'pick_up_id' => 2,
        ]);

        DB::table('pick_up_product')->insert([
          'product_id' => 3,
          'pick_up_id' => 2,
        ]);


        // Margherita

        DB::table('pickups')->insert([
            'identifier'  => (string) Str::uuid(),
            'pu_type_id' => 1,
            'pu_time_slot_id' => 2,
            'restaurant_id' => 1,
            'name' => 'Pizza Margherita',
            'cover_image' => 'https://i.ibb.co/GxFkNnb/Pizza-Margherita.jpg',
            'quantity' => 20,
            'price' => 7,
            'status' => 1
        ]);

        DB::table('pick_up_product')->insert([
          'product_id' => 1,
          'pick_up_id' => 3,
        ]);


    ######## PICKUPS - Baobab #########

        // Hamburger a scelta

      DB::table('pickups')->insert([
          'identifier'  => (string) Str::uuid(),
          'pu_type_id' => 1,
          'pu_time_slot_id' => 2,
          'restaurant_id' => 2,
          'name' => 'Hamburger a scelta',
          'cover_image' => 'https://i.ibb.co/d4jrH1t/Hamburger.jpg',
          'quantity' => 10,
          'price' => 7,
          'status' => 1
      ]);

        DB::table('pick_up_product')->insert([
           'product_id' => 4,
           'pick_up_id' => 4,
         ]);

         DB::table('pick_up_product')->insert([
           'product_id' => 5,
           'pick_up_id' => 4,
         ]);

    // Hamburger

    DB::table('pickups')->insert([
        'identifier'  => (string) Str::uuid(),
        'pu_type_id' => 1,
        'pu_time_slot_id' => 2,
        'restaurant_id' => 2,
        'name' => 'Hamburger a scelta',
        'cover_image' => 'https://i.ibb.co/4jy0k65/Hamburger-scamorza.jpg',
        'quantity' => 10,
        'price' => 7,
        'status' => 1
    ]);

      DB::table('pick_up_product')->insert([
         'product_id' => 5,
         'pick_up_id' => 5,
       ]);

    ######## PICKUPS - Sushi #########

      // Uramaki

    DB::table('pickups')->insert([
        'identifier'  => (string) Str::uuid(),
        'pu_type_id' => 1,
        'pu_time_slot_id' => 2,
        'restaurant_id' => 3,
        'name' => 'Uramaki salmon roll',
        'cover_image' => 'https://i.ibb.co/hVyQF0q/Sushi.jpg',
        'quantity' => 10,
        'price' => 14,
        'status' => 1
    ]);

      DB::table('pick_up_product')->insert([
         'product_id' => 7,
         'pick_up_id' => 6,
       ]);

    ######## PICKUPS - Testone #########

      // Pasta

    DB::table('pickups')->insert([
        'identifier'  => (string) Str::uuid(),
        'pu_type_id' => 1,
        'pu_time_slot_id' => 1,
        'restaurant_id' => 4,
        'name' => 'Pasta al sugo',
        'cover_image' => 'url_image.jpg',
        'quantity' => 10,
        'price' => 7,
        'status' => 1
    ]);

      DB::table('pick_up_product')->insert([
         'product_id' => 6,
         'pick_up_id' => 7,
       ]);
    }
}
