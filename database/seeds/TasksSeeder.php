<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([ //1
            'name' => 'Torching Mineral',
            'alias' => 'torchmineral',
            'unit_of_measure' => 'm2',
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //2
            'name' => 'Membrane and Acrylic Flashing',
            'alias' => 'acrylicflashing',
            'unit_of_measure' => 'lm',
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //3
            'name' => 'Stripping',
            'alias' => 'stripping',
            'unit_of_measure' => 'm2',
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //4
            'name' => 'Boarding Sanika Boards',
            'alias' => 'sanikaboarding',
            'unit_of_measure' => 'm2',
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //5
            'name' => 'Boarding Wooden',
            'alias' => 'woodenboarding',
            'unit_of_measure' => 'm2',
            'created_at' => Carbon::now()
        ]);
    }
}