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
        DB::table('system')->insert([
            'name' => 'Concrete Roof Maintenance-Free Torch-on',
            'description' => '',
            'unit' => 'm2',
            'base_rate' => 250.00,
            'component' => 'ConcreteMineralTorchOnSystem',
            'created_at' => Carbon::now()
        ]);
        DB::table('system')->insert([
            'name' => 'Sanika Boarded Maintenance-Free Torch-on',
            'description' => '',
            'unit' => 'm2',
            'base_rate' => 450.00,
            'component' => 'SanikaBoardedMineralTorchOnSystem',
            'created_at' => Carbon::now()
        ]);
    }
}
