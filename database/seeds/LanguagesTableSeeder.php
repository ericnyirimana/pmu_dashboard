<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('languages')->insert([
          'code' => 'en',
          'language' => 'English'
      ]);
      DB::table('languages')->insert([
          'code' => 'it',
          'language' => 'Italiano'
      ]);
      DB::table('languages')->insert([
          'code' => 'pt',
          'language' => 'Português'
      ]);
      
    }
}
