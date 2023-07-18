<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PandgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pandgs')->insert([
            'name' => 'Aluminium Scaffold',
            'description' => 'Supply and erect Alluminium Scaffolding in accordance with OHS and client requirements',
            'rate' => 2000000,
            'period' => 'fixed',
            'created_at' => Carbon::now(),
        ]);

        DB::table('pandgs')->insert([
            'name' => 'Specialised Access',
            'description' => 'Supply and erect specialised ladders to achieve safe access in accordance with OHS and client requirements',
            'rate' => 500000,
            'period' => 'fixed',
            'created_at' => Carbon::now(),
        ]);
    }
}
