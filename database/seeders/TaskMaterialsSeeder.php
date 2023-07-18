<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'task_id' => 1,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 2,
            'task_id' => 1,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 4,
            'task_id' => 1,
        ]);

        //Torching Plain
        DB::table('material_task')->insert([
            'material_id' => 49,
            'task_id' => 8,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 4,
            'task_id' => 8,
        ]);
        // Silvakote
        DB::table('material_task')->insert([
            'material_id' => 59,
            'task_id' => 43,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 60,
            'task_id' => 43,
        ]);

        //Torch Primer
        DB::table('material_task')->insert([
            'material_id' => 3,
            'task_id' => 6,
        ]);

        //Membrane Boarded
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 2,
            'area' => '*0.1',
        ]);
        //200
        DB::table('material_task')->insert([
            'material_id' => 6,
            'task_id' => 2,
            'area' => '*0.2',
        ]);
        //300
        DB::table('material_task')->insert([
            'material_id' => 7,
            'task_id' => 2,
            'area' => '*0.333',
        ]);
        //500
        DB::table('material_task')->insert([
            'material_id' => 8,
            'task_id' => 2,
            'area' => '*0.5',
        ]);
        //1000
        DB::table('material_task')->insert([
            'material_id' => 9,
            'task_id' => 2,
            'area' => '*1',
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 2,
        ]);

        //Fillets
        DB::table('material_task')->insert([
            'material_id' => 23,
            'task_id' => 9,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 24,
            'task_id' => 9,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 25,
            'task_id' => 9,
        ]);

        //Poly
        DB::table('material_task')->insert([
            'material_id' => 33,
            'task_id' => 11,
        ]);

        //Boarded
        DB::table('material_task')->insert([
            'material_id' => 11,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 12,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 13,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 14,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 15,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 16,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 17,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 18,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 19,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 20,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 21,
            'task_id' => 4,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 22,
            'task_id' => 4,
        ]);

        DB::table('material_task')->insert([
            'material_id' => 26,
            'task_id' => 4, /*,
            'area' => '*3.47222222222222'*/
        ]);
        DB::table('material_task')->insert([
            'material_id' => 27,
            'task_id' => 4, /*,
            'area' => '*3.47222222222222'*/
        ]);
        DB::table('material_task')->insert([
            'material_id' => 28,
            'task_id' => 10,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 29,
            'task_id' => 10,
        ]);

        //Screed Repair
        /*DB::table('material_task')->insert([
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
        ]);*/
        DB::table('material_task')->insert([
            'material_id' => 58,
            'task_id' => 7,
        ]);

        //Membrane IBR Coating
        //boltheads
        //screws
        DB::table('material_task')->insert([
            'material_id' => 26, //tek screws 50mm
            'task_id' => 13,
            'area' => '*0.1',
        ]);

        //membrane patches
        DB::table('material_task')->insert([
            'material_id' => 39,
            'task_id' => 14,
            'area' => '/32.32/2',
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
            'area' => '*1.6*0.1',
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 15,
        ]);

        //Klip-lockOverlaps
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 42,
            'area' => '*3.2*0.1',
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 42,
        ]);

        //Crosslaps
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 16,
            'area' => '*0.1',
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
            'area' => '*0.1',
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 17,
        ]);

        //Frogskin
        DB::table('material_task')->insert([
            'material_id' => 34,
            'task_id' => 18,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 35,
            'task_id' => 18,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 36,
            'task_id' => 18,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 37,
            'task_id' => 18,
        ]);
        DB::table('material_task')->insert([
            'material_id' => 38,
            'task_id' => 18,
        ]);

        //Tile Roof
        //Ridging
        //200
        DB::table('material_task')->insert([
            'material_id' => 6,
            'task_id' => 19,
            'area' => '*3*0.2',
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 19,
        ]);

        //Valleys
        //100
        DB::table('material_task')->insert([
            'material_id' => 5,
            'task_id' => 20,
            'area' => '*0.1',
        ]);
        //300
        DB::table('material_task')->insert([
            'material_id' => 7,
            'task_id' => 20,
            'area' => '*0.3',
        ]);
        //Acrylic
        DB::table('material_task')->insert([
            'material_id' => 10,
            'task_id' => 20,
        ]);

        //Valleys
        //Plain (Mineral)
        DB::table('material_task')->insert([
            'material_id' => 1,
            'task_id' => 21,
            'area' => '*0.95',
        ]);

        //Coating
        //Frogskin
        DB::table('material_task')->insert([
            'material_id' => 34,
            'task_id' => 22,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 35,
            'task_id' => 22,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 36,
            'task_id' => 22,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 37,
            'task_id' => 22,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 38,
            'task_id' => 22,
            'area' => '+((property/100)*10))',
        ]);

        //Corrugated Coating
        //Frogskin
        DB::table('material_task')->insert([
            'material_id' => 34,
            'task_id' => 23,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 35,
            'task_id' => 23,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 36,
            'task_id' => 23,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 37,
            'task_id' => 23,
            'area' => '+((property/100)*10))',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 38,
            'task_id' => 23,
            'area' => '+((property/100)*10))',
        ]);

        //Kryton Crack Repair

        //Sandblasting
        DB::table('material_task')->insert([
            'material_id' => 44, //Grit
            'task_id' => 27, // sandblasting
        ]);
        DB::table('material_task')->insert([
            'material_id' => 42, //Diesel generator
            'task_id' => 27, // sandblasting
        ]);

        //Plug
        DB::table('material_task')->insert([
            'material_id' => 45, //Plug
            'task_id' => 29, //Plug
        ]);

        //Grout
        DB::table('material_task')->insert([
            'material_id' => 46, //Grout
            'task_id' => 30, //Close Crack
        ]);

        //Close Honeycomb
        DB::table('material_task')->insert([
            'material_id' => 46, //Grout
            'task_id' => 31, //Close Honey
        ]);

        //Close Tieholes
        DB::table('material_task')->insert([
            'material_id' => 46, //Grout
            'task_id' => 32, //Close Tie Holes,
            'coverage' => 100,
        ]);

        //T1Slurry
        DB::table('material_task')->insert([
            'material_id' => 47, //T1Slurry
            'task_id' => 34, //T1Slurry
        ]);

        //T2Slurry
        DB::table('material_task')->insert([
            'material_id' => 48, //T2Slurry
            'task_id' => 36, //T2Slurry
        ]);

        // Plaster with KMA
        DB::table('material_task')->insert([
            'material_id' => 31, //Cement
            'task_id' => 37, // Plaster with KMA
        ]);
        DB::table('material_task')->insert([
            'material_id' => 53, //PlasterSand
            'task_id' => 37, // Plaster with KMA
        ]);
        DB::table('material_task')->insert([
            'material_id' => 52, //KMA
            'task_id' => 37, // Plaster with KMA
        ]);

        DB::table('material_task')->insert([
            'material_id' => 54, // Alkali Primer
            'task_id' => 38, // Alkali Prime
        ]);
        DB::table('material_task')->insert([
            'material_id' => 55, // Hydroscopic COating MCC 210?
            'task_id' => 39, // Hydroscopic Coat
        ]);
        DB::table('material_task')->insert([
            'material_id' => 56, // Hydroscopic COating MCC 211?
            'task_id' => 39, // Hydroscopic Coat
        ]);
        DB::table('material_task')->insert([
            'material_id' => 57, // Hydroscopic COating MCC Multiond?
            'task_id' => 39, // Hydroscopic Coat
        ]);

        DB::table('material_task')->insert([
            'material_id' => 38, // Frogskin white
            'task_id' => 40, // Hydroscopic Coat
            'area' => '*2',
        ]);

        //coating
        DB::table('material_task')->insert([
            'material_id' => 38, // Frogskin white
            'task_id' => 41, //  Coat
            'area' => '*2',
        ]);
        DB::table('material_task')->insert([
            'material_id' => 34, // Frogskin grey
            'task_id' => 41, //  Coat
        ]);
        DB::table('material_task')->insert([
            'material_id' => 35, // Frogskin terra
            'task_id' => 41, //  Coat
        ]);
        DB::table('material_task')->insert([
            'material_id' => 36, // Frogskin green
            'task_id' => 41, //  Coat
        ]);
        DB::table('material_task')->insert([
            'material_id' => 37, // Frogskin brown
            'task_id' => 41, //  Coat
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
