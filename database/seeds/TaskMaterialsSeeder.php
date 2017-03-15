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
            'material_id' => 4,
            'task_id' => 1
        ]);

        //Torch Primer
        DB::table('material_task')->insert([
            'material_id' => 3,
            'task_id' => 6
        ]);

        //Membrane Boarded
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 2,
            'area' => '*0.1'
        ]);
        //200
        DB::table('material_task')->insert([
            'material_id' => 6,
            'task_id' => 2,
            'area' => '*0.2'
        ]);
        //300
        DB::table('material_task')->insert([
            'material_id' => 7,
            'task_id' => 2,
            'area' => '*0.333'
        ]);
        //500
        DB::table('material_task')->insert([
            'material_id' => 8,
            'task_id' => 2,
            'area' => '*0.5'
        ]);
        //1000
        DB::table('material_task')->insert([
            'material_id' => 9,
            'task_id' => 2,
            'area' => '*1'
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 2
        ]);

        //Fillets
        DB::table('material_task')->insert([
            'material_id' => 23,
            'task_id' => 9
        ]);
        DB::table('material_task')->insert([
            'material_id' => 24,
            'task_id' => 9
        ]);
        DB::table('material_task')->insert([
            'material_id' => 25,
            'task_id' => 9
        ]);

        //Poly
        DB::table('material_task')->insert([
            'material_id' => 33,
            'task_id' => 11
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
            'material_id' => 26,
            'task_id' => 4,
            'area' => '*3.47222222222222'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 27,
            'task_id' => 4,
            'area' => '*3.47222222222222'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 28,
            'task_id' => 10
        ]);
        DB::table('material_task')->insert([
            'material_id' => 29,
            'task_id' => 10
        ]);

        //Screed Repair
        DB::table('material_task')->insert([
            'material_id' => 30,
            'task_id' => 7
        ]);
        DB::table('material_task')->insert([
            'material_id' => 31,
            'task_id' => 7
        ]);
        DB::table('material_task')->insert([
            'material_id' => 32,
            'task_id' => 7
        ]);

        //Membrane IBR Coating
        //boltheads
        //screws
        DB::table('material_task')->insert([
            'material_id' => 26, //tek screws 50mm
            'task_id' => 13,
        ]);

        //membrane patches
        DB::table('material_task')->insert([
            'material_id' => 39,
            'task_id' => 14,
            'area' => '*0.03'
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 14,
        ]);

        //Overlaps
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 15,
            'area' => '*1.6*0.1'
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 15,
        ]);

        //Crosslaps
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 16,
            'area' => '*0.1'
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 16,
        ]);

        //Perimeter
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 17,
            'area' => '*0.1'
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 17,
        ]);

        //Frogskin
        DB::table('material_task')->insert([
            'material_id' => 34,
            'task_id' => 18
        ]);
        DB::table('material_task')->insert([
            'material_id' => 35,
            'task_id' => 18
        ]);
        DB::table('material_task')->insert([
            'material_id' => 36,
            'task_id' => 18
        ]);
        DB::table('material_task')->insert([
            'material_id' => 37,
            'task_id' => 18
        ]);
        DB::table('material_task')->insert([
            'material_id' => 38,
            'task_id' => 18
        ]);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
