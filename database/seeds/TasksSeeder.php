<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tasks')->insert([ //1
            'name' => 'Torching Mineral',
            'description' => 'Install mineral surface, maintenace-free, heat bonded, industrial grade torch-on waterproofing membrane',
            'alias' => 'torchmineral',
            'unit_of_measure' => 'm2',
            'rate' => 150,
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //2
            'name' => 'Membrane and Acrylic Flashing',
            'description' => 'Terminate all waterproofing including protrusions, upstands, headwalls and side-walls using non-woven, polyester membrane empregnated with 100% pure acrylis waterproofing compound',
            'alias' => 'acrylicflashing',
            'unit_of_measure' => 'lm',
            'link_to' => 'perimeter',
            'rate' => 100,
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //3
            'name' => 'Stripping',
            'description' => 'Strip entire area of existing waterproofing and discard',
            'alias' => 'stripping',
            'unit_of_measure' => 'm2',
            'rate' => 150,
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //4
            'name' => 'Boarding Sanika Boards',
            'description' => 'Mechanically install the Sanika light-weight, highly-insulative boards',
            'alias' => 'sanikaboarding',
            'unit_of_measure' => 'm2',
            'rate' => 150,
            'created_at' => Carbon::now()
        ]);
        
        DB::table('tasks')->insert([ //5
            'name' => 'Boarding Wooden',
            'description' => 'Mechanically install 16mm marine-grade wooden OSB boards',
            'alias' => 'woodenboarding',
            'unit_of_measure' => 'm2',
            'rate' => 150,
            'created_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([ //6
            'name' => 'Priming Torch-on',
            'description' => 'Prime the entire upper surface of newly installed boards with heat activated primer',
            'alias' => 'primetorch',
            'unit_of_measure' => 'm2',
            'rate' => 1000,
            'created_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([ //7
            'name' => 'Screed Repair',
            'description' => 'Where required, repair substrate by removing and lose areas and re-screed to correct falls to the outlets for correct drainage',
            'alias' => 'screedrepair',
            'unit_of_measure' => 'm2',
            'link_to' => 'screed',
            'rate' => 80,
            'created_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([ //8
            'name' => 'Torching Plain',
            'description' => 'Install plain, heat bonded, industrial grade torch-on waterproofing membrane',
            'alias' => 'torchplain',
            'unit_of_measure' => 'm2',
            'rate' => 150,
            'created_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([ //9
            'name' => 'Establish Site',
            'description' => 'Establish site and safe working environment',
            'alias' => 'establishsite',
            'unit_of_measure' => 'days',
            'rate' => 0.5,
            'created_at' => Carbon::now()
        ]);
        DB::table('tasks')->insert([ //10
            'name' => 'De-establish Site',
            'description' => 'Clean and de-establish site',
            'alias' => 'deestablishsite',
            'unit_of_measure' => 'days',
            'rate' => 0.5,
            'created_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([ //11
            'name' => 'Install Fillets',
            'description' => 'Install laser-cut foam moulds of the sheet trough',
            'alias' => 'fillets',
            'unit_of_measure' => 'm2',
            'rate' => 150,
            'created_at' => Carbon::now()
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
