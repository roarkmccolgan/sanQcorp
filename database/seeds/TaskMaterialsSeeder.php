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

        //Torching Plain
        DB::table('material_task')->insert([
            'material_id' => 49,
            'task_id' => 8
        ]);
        DB::table('material_task')->insert([
            'material_id' => 4,
            'task_id' => 8
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

        //Tile Roof
        //Ridging
        //200
        DB::table('material_task')->insert([
            'material_id' => 6,
            'task_id' => 19,
            'area' => '*3*0.2'
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 19,
        ]);

        //Sidewall
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 20,
            'area' => '*0.3'
        ]);
        //300
        DB::table('material_task')->insert([
            'material_id' => 7,
            'task_id' => 20
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 20,
        ]);

        //Sidewall
        //Plain (Mineral)
        DB::table('material_task')->insert([
            'material_id' => 1,
            'task_id' => 21,
            'area' => '*0.95'
        ]);

        //Coating
        //Frogskin
        DB::table('material_task')->insert([
            'material_id' => 34,
            'task_id' => 22,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 35,
            'task_id' => 22,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 36,
            'task_id' => 22,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 37,
            'task_id' => 22,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 38,
            'task_id' => 22,
            'area' => '+((property/100)*10))'
        ]);

        //Corrugated Coating
        //Frogskin
        DB::table('material_task')->insert([
            'material_id' => 34,
            'task_id' => 23,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 35,
            'task_id' => 23,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 36,
            'task_id' => 23,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 37,
            'task_id' => 23,
            'area' => '+((property/100)*10))'
        ]);
        DB::table('material_task')->insert([
            'material_id' => 38,
            'task_id' => 23,
            'area' => '+((property/100)*10))'
        ]);

        //Kryton Crack Repair
        //Chipping
        DB::table('material_task')->insert([
            'material_id' => 41,//Petrol generator
            'task_id' => 24, // Chipping
        ]);
        DB::table('material_task')->insert([
            'material_id' => 42,//Diesel generator
            'task_id' => 24, // Chipping
        ]);
        DB::table('material_task')->insert([
            'material_id' => 43,//Electricity
            'task_id' => 24, // Chipping
        ]);

        //Sandblasting
        DB::table('material_task')->insert([
            'material_id' => 44,//Grit
            'task_id' => 25, // sandblasting
        ]);
        DB::table('material_task')->insert([
            'material_id' => 41,//Petrol generator
            'task_id' => 25, // sandblasting
        ]);
        DB::table('material_task')->insert([
            'material_id' => 42,//Diesel generator
            'task_id' => 25, // sandblasting
        ]);
        DB::table('material_task')->insert([
            'material_id' => 43,//Electricity
            'task_id' => 25, // sandblasting
        ]);

        //Pressure Cleaning
        DB::table('material_task')->insert([
            'material_id' => 41,//Petrol generator
            'task_id' => 26, // Pressure Cleaning
        ]);
        DB::table('material_task')->insert([
            'material_id' => 42,//Diesel generator
            'task_id' => 26, // Pressure Cleaning
        ]);
        DB::table('material_task')->insert([
            'material_id' => 43,//Electricity
            'task_id' => 26, // Pressure Cleaning
        ]);

        //Honeycombing
        DB::table('material_task')->insert([
            'material_id' => 41,//Petrol generator
            'task_id' => 27, // Honeycombing
        ]);
        DB::table('material_task')->insert([
            'material_id' => 42,//Diesel generator
            'task_id' => 27, // Honeycombing
        ]);
        DB::table('material_task')->insert([
            'material_id' => 43,//Electricity
            'task_id' => 27, // Honeycombing
        ]);

        //Plug
        DB::table('material_task')->insert([
            'material_id' => 45,//Plug
            'task_id' => 28, //Plug
        ]);

        //Grout
        DB::table('material_task')->insert([
            'material_id' => 46,//Grout
            'task_id' => 29, //Grout
        ]);

        //T1Slurry
        DB::table('material_task')->insert([
            'material_id' => 47,//T1Slurry
            'task_id' => 31, //T1Slurry
        ]);

        //T2Slurry
        DB::table('material_task')->insert([
            'material_id' => 48,//T2Slurry
            'task_id' => 33, //T2Slurry
        ]);
        

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
