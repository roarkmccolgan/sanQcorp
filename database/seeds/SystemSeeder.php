<?php

use Carbon\Carbon;
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
        DB::table('system')->insert([ //1
            'name' => 'Concrete Roof Maintenance-Free Torch-on',
            'description' => 'This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
            'alias' => 'Mineral Maintenance-Free Torch-on System',
            'unit' => 'm2',
            'base_rate' => 250.00,
            'component' => 'ConcreteMineralTorchOnSystem',
            'created_at' => Carbon::now()
        ]);
        DB::table('system')->insert([ //2
            'name' => 'Sanika Boarded Maintenance-Free Torch-on',
            'description' => 'Our insulative boarded system is awesome. This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
            'alias' => 'Sanika\'s insulative Boarded System',
            'unit' => 'm2',
            'base_rate' => 450.00,
            'component' => 'SanikaBoardedMineralTorchOnSystem',
            'created_at' => Carbon::now()
        ]);
    }
}
