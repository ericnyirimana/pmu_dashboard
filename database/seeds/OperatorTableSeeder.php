<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OperatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

      DB::table('roles_types')->insert([
          'name' => 'PMU Admin',
          'level' => 1
      ]);
      DB::table('roles_types')->insert([
          'name' => 'Owner',
          'level' => 2
      ]);
      DB::table('roles_types')->insert([
          'name' => 'Manager',
          'level' => 3
      ]);

      DB::table('operators')->insert([
          'name' => '21ilab',
          'email' => 'admin@21ilab.com',
          'password' => Hash::make('21iLAB2020!'),
          'role_type_id' => 1
      ]);

      DB::table('operators')->insert([
          'name' => 'PMU',
          'email' => 'admin@pmu.com',
          'password' => Hash::make('gdxgj5802'),
          'role_type_id' => 2
      ]);
    }
}
