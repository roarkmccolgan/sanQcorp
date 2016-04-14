<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        //Torching Mineral
        DB::table('material_task')->insert([
            'material_id' => 1,
            'task_id' => 1
        ]);
        DB::table('material_task')->insert([
            'material_id' => 2,
            'task_id' => 1
        ]);
        DB::table('material_task')->insert([
            'material_id' => 3,
            'task_id' => 1
        ]);
        DB::table('material_task')->insert([
            'material_id' => 4,
            'task_id' => 1
        ]);

        //Membrane
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 2
        ]);
        DB::table('material_task')->insert([
            'material_id' => 6,
            'task_id' => 2
        ]);
        DB::table('material_task')->insert([
            'material_id' => 7,
            'task_id' => 2
        ]);
        DB::table('material_task')->insert([
            'material_id' => 8,
            'task_id' => 2
        ]);
        DB::table('material_task')->insert([
            'material_id' => 9,
            'task_id' => 2
        ]);
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 2
        ]);

        //Boarded
        DB::table('material_task')->insert([
            'material_id' => 11,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 12,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 13,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 14,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 15,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 16,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 17,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 18,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 19,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 20,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 21,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 22,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 23,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 24,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 25,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 26,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 27,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 28,
            'task_id' => 4
        ]);
        DB::table('material_task')->insert([
            'material_id' => 29,
            'task_id' => 4
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
