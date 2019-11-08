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
          'password' => Hash::make('21iLAB2021!'),
          'remember_token'   => '8765434567654',
          
      ]);
      DB::table('users')->insert([
          'name' => 'Pick Meal Up',
          'email' => 'admin@pmu.com',
          'password' => Hash::make('yGNE0H85T7O'),
          'remember_token'   => '6785645',

      ]);

    }
}
