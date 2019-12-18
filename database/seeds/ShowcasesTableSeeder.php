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
          'title' => 'Option 1',
      ]);

      DB::table('showcases')->insert([
          'identifier'  => (string) Str::uuid(),
          'title' => 'Option 2',
      ]);

      /** timeslot **/
      DB::table('showcase_time_slot')->insert([
          'showcase_id'   => 1,
          'time_slot_id'   => 1,
      ]);

      DB::table('showcase_time_slot')->insert([
          'showcase_id'   => 1,
          'time_slot_id'   => 2,
      ]);

      DB::table('showcase_time_slot')->insert([
          'showcase_id'   => 2,
          'time_slot_id'   => 2,
      ]);

      /** pickups **/
      DB::table('showcase_pick_up')->insert([
          'showcase_id'   => 1,
          'pick_up_id'   => 1,
      ]);

      /** pickups **/
      DB::table('showcase_pick_up')->insert([
          'showcase_id'   => 2,
          'pick_up_id'   => 1,
      ]);

    }
}
