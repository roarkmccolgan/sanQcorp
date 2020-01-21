<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fuels')->insert([
            'type' => 'diesel',
            'valid_from' => Carbon::now(),
            'rate_per_km' => 400
        ]);
        DB::table('fuels')->insert([
            'type' => 'petrol',
            'valid_from' => Carbon::now(),
            'rate_per_km' => 500
        ]);
    }
}
