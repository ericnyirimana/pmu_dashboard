<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('product_images')->insert([
        'product_id' => 1,
        'name'  => 'Image Cover',
        'image'  => 'cover.jpg',
        'order' => 0,
      ]);
      DB::table('product_images')->insert([
        'product_id' => 1,
        'name'  => 'Image 1',
        'image' => 'image1.png',
        'order' => 1,
      ]);
      DB::table('product_images')->insert([
        'product_id' => 1,
        'name'  => 'Image 2',
        'image' => 'image2.png',
      ]);
    }
}
