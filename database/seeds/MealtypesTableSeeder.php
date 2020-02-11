<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MealtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


      DB::table('mealtypes')->insert([
          'hour_ini'  => '10:00',
          'hour_end'  => '15:00',
      ]);

      DB::table('mealtype_translations')->insert([
          'mealtype_id'  => 1,
          'name'        => 'Pranzo',
          'code'        => 'it'
      ]);


      DB::table('mealtype_translations')->insert([
          'mealtype_id'  => 1,
          'name'        => 'Lunch',
          'code'        => 'en'
      ]);

      DB::table('mealtypes')->insert([
          'hour_ini'  => '18:00',
          'hour_end'  => '22:00',
      ]);

      DB::table('mealtype_translations')->insert([
          'mealtype_id'  => 2,
          'name'        => 'Cena',
          'code'        => 'it'
      ]);

      DB::table('mealtype_translations')->insert([
          'mealtype_id'  => 2,
          'name'        => 'Dinner',
          'code'        => 'en'
      ]);

    }
}
