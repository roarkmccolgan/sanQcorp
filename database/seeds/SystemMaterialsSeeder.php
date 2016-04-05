<?php

use Illuminate\Database\Seeder;

class SystemMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('material_system')->insert([
            'material_id' => 1,
            'system_id' => 1,
            'quantity' => 0.00
        ]);
        DB::table('material_system')->insert([
            'material_id' => 2,
            'system_id' => 1,
            'quantity' => 0.00
        ]);
        DB::table('material_system')->insert([
            'material_id' => 3,
            'system_id' => 1,
            'quantity' => 0.00
        ]);
        DB::table('material_system')->insert([
            'material_id' => 4,
            'system_id' => 1,
            'quantity' => 0.00
        ]);
        DB::table('material_system')->insert([
            'material_id' => 5,
            'system_id' => 1,
            'quantity' => 0.00
        ]);
    }
}
