<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fuel')->insert([
            'type' => 'diesel',
            'valid_from' => Carbon::now(),
            'rate_per_km' => 4
        ]);
        DB::table('fuel')->insert([
            'type' => 'petrol',
            'valid_from' => Carbon::now(),
            'rate_per_km' => 5
        ]);
    }
}
