<?php

use Carbon\Carbon;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Concrete
        DB::table('material_system')->insert([
            'material_id' => 1,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 2,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 3,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 4,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 5,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 6,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 7,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 8,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 9,
            'system_id' => 1
        ]);
        DB::table('material_system')->insert([
            'material_id' => 10,
            'system_id' => 1
        ]);

        //boarded
        //
        DB::table('material_system')->insert([
            'material_id' => 1,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 2,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 3,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 4,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 5,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 6,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 7,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 8,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 9,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 10,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 11,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 12,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 13,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 14,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 15,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 16,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 17,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 18,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 19,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 20,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 21,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 22,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 23,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 24,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 25,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 26,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 27,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 28,
            'system_id' => 2
        ]);
        DB::table('material_system')->insert([
            'material_id' => 29,
            'system_id' => 2
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
