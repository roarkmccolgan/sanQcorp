<?php

use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system')->insert([
            'name' => 'Concrete Roof Maintenance-Free Torh-on',
            'unit' => 'm2',
            'base_rate' => 250.00,
            'created_at' => Carbon::now()
        ]);
    }
}
