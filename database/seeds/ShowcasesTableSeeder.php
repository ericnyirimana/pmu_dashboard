<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShowcasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


      DB::table('showcases')->insert([
          'identifier'  => (string) Str::uuid(),
          'type'  => 'timeslots',
          'items'  =>  'pranzo'
      ]);

      DB::table('showcase_translations')->insert([
          'showcase_id' => 1,
          'name' => 'Pranzo Tempo',
          'code'  => 'it'
      ]);

      DB::table('showcase_translations')->insert([
          'showcase_id' => 1,
          'name' => 'Lunch Time',
          'code'  => 'en'
      ]);

      DB::table('showcases')->insert([
          'identifier'  => (string) Str::uuid(),
          'type'  => 'timeslots',
          'items' => 'cena'
      ]);

      DB::table('showcase_translations')->insert([
          'showcase_id' => 2,
          'name' => 'Cena Tempo',
          'code'  => 'it'
      ]);

      DB::table('showcase_translations')->insert([
          'showcase_id' => 2,
          'name' => 'Cena Time',
          'code'  => 'en'
      ]);


    }
}
