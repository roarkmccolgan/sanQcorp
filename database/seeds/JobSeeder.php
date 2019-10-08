<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            'order_number' => 'SAN7029-16',
            /*'user_id' => 2,*/
            'name' => 'Pinmill Farms Lawyers Office',
            'distance' => 38,
            'status' => 'build',
            'address' => '12 Katherine Street',
            'suburb' => 'Sandton',
            'city' => 'Johannesburg',
            'country' => 'South Africa',
            'type' => 'service',
            'created_at' => Carbon::now()
        ]);
        /*DB::table('jobs')->insert([
            'order_number' => 'SAN7030-17',
            'user_id' => 2,
            'name' => 'Bungalow Pool',
            'distance' => 1206,
            'status' => 'build',
            'address' => '37 Dundee Street',
            'suburb' => 'Kraaifontein',
            'city' => 'Cape Town',
            'country' => 'South Africa',
            'type' => 'supply',
            'created_at' => Carbon::now()
        ]);*/
    }
}
