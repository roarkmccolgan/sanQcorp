<?php

use Illuminate\Database\Seeder;

class TaskPropertySeeder extends Seeder
{
	//area =1 
    //perimeter =2 
    //crosslaps =3 
    //width =4
    //height =5
    //volume = 6
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Torch Mineral
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 1
        ]);

        //Membrane and Acrylic Flashing
        DB::table('property_task')->insert([
            'property_id' => 2,
            'task_id' => 2
        ]);

        //Stripping
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 3
        ]);

        //Boarding Sanika Boards
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 4
        ]);

        //Boarding Wooden Boards
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 5
        ]);

        //Prime Torch-on
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 6
        ]);

        //Screed Repair
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 7
        ]);

        //Torching Plain
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 8
        ]);

        //Install Fillets
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 9
        ]);

        //Galvenised Flashing
        DB::table('property_task')->insert([
            'property_id' => 2,
            'task_id' => 10
        ]);

        //Ployeurethane Boards
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 11
        ]);

        //IBR Coating
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 12,
            'conversion' => '*1.2755'
        ]);

        //Re-fasten
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 13
        ]);

        //Waterproof
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 14
        ]);
        DB::table('property_task')->insert([
            'property_id' => 2,
            'task_id' => 14
        ]);
        DB::table('property_task')->insert([
            'property_id' => 3,
            'task_id' => 14
        ]);

        //Coating
        DB::table('property_task')->insert([
            'property_id' => 1,
            'task_id' => 15
        ]);

        //Sidewall
        DB::table('property_task')->insert([
            'property_id' => 8,
            'task_id' => 20
        ]);

        //Ridge
        DB::table('property_task')->insert([
            'property_id' => 7,
            'task_id' => 19
        ]);

        //Valleys
        DB::table('property_task')->insert([
            'property_id' => 9,
            'task_id' => 21
        ]);

        //Crosslaps
        DB::table('property_task')->insert([
            'property_id' => 3,
            'task_id' => 16
        ]);
    }
}
