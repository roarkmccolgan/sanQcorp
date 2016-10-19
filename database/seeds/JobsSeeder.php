<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
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
            'user_id' => 2,
            'name' => 'Pinmill Farms Lawyers Office',
            'distance' => 38,
            'status' => 'build',
            'address' => '12 Katherine Street',
            'suburb' => 'Sandton',
            'city' => 'Johannesburg',
            'country' => 'South Africa',
            'created_at' => Carbon::now()
        ]);
    }
}
