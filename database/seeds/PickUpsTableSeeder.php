<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PickUpsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Timeslots Pickup

        DB::table('timeslots')->insert([
            'identifier'  => (string) Str::uuid(),
            'restaurant_id' => 1,
            'mealtype_id' => 1,
            'hour_ini' => '11:00',
            'hour_end' => '14:00',
            'fixed'   => true,
        ]);

        DB::table('timeslots')->insert([
            'identifier'  => (string) Str::uuid(),
            'restaurant_id' => 1,
            'mealtype_id' => 2,
            'hour_ini' => '19:00',
            'hour_end' => '21:00',
            'fixed'   => true,
        ]);

        ######## PICKUPS - Sorbillo #########

        // COMBO - Pizza + bibita

      DB::table('pickups')->insert([
          'type_pickup' => 'offer',
          'identifier'  => (string) Str::uuid(),
          'timeslot_id' => 1,
          'restaurant_id' => 1,
          'status' => 1,
          'date_ini'  => Carbon::now(),
          'date_end'  => Carbon::now()->addDays(10)
      ]);

      DB::table('pickup_offers')->insert([
         'pickup_id' => 1,
         'type_offer' => 'combo',
         'quantity_offer' => 10,
         'quantity_remain' => 10,
         'price' => 7,
       ]);

      DB::table('pickup_translations')->insert([
         'pickup_id' => 1,
         'name' => 'Pizza a scelta + bibita a scelta',
         'code' => 'it'
       ]);

       DB::table('pickup_translations')->insert([
          'pickup_id' => 1,
          'name' => 'Choose Pizza + Choose Drink',
          'code' => 'en'
        ]);

        DB::table('pickup_products')->insert([
          'product_id' => 1,
          'pickup_id' => 1,
        ]);

        DB::table('pickup_products')->insert([
          'product_id' => 2,
          'pickup_id' => 1,
        ]);


        // Pizza a scelta

        DB::table('pickups')->insert([
          'type_pickup' => 'offer',
          'identifier'  => (string) Str::uuid(),
          'timeslot_id' => 2,
          'restaurant_id' => 1,
          'status' => 1,
          'date_ini'  => Carbon::now(),
          'date_end'  => Carbon::now()->addDays(10)
        ]);

        DB::table('pickup_offers')->insert([
           'pickup_id' => 2,
           'type_offer' => 'simple',
           'quantity_offer' => 20,
           'quantity_remain' => 20,
           'price' => 7,
         ]);

        DB::table('pickup_translations')->insert([
           'pickup_id' => 2,
           'name' => 'Pizza a scelta',
           'code' => 'it'
         ]);

         DB::table('pickup_translations')->insert([
            'pickup_id' => 2,
            'name' => 'Choose Pizza',
            'code' => 'en'
          ]);

          DB::table('pickup_products')->insert([
            'product_id' => 3,
            'pickup_id' => 2,
          ]);

          DB::table('pickup_products')->insert([
            'product_id' => 4,
            'pickup_id' => 2,
          ]);

          /*
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

    // Timeslots Pickup

    DB::table('timeslots')->insert([
        'identifier'  => (string) Str::uuid(),
        'restaurant_id' => 2,
        'mealtype_id' => 1,
        'hour_ini' => '11:00',
        'hour_end' => '15:00',
        'fixed'   => true,
    ]);

    DB::table('timeslots')->insert([
        'identifier'  => (string) Str::uuid(),
        'restaurant_id' => 2,
        'mealtype_id' => 2,
        'hour_ini' => '18:00',
        'hour_end' => '22:00',
        'fixed'   => true,
    ]);

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

       */
    }
}
