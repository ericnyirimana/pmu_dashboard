<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'Admin 21ilab',
          'email' => 'admin@21ilab.com',


      ]);
      DB::table('users')->insert([
          'name' => 'Pick Meal Up',
          'email' => 'admin@pmu.com',
          

      ]);

    }
}
