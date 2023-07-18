<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scope')->insert([ //1
            'name' => 'Establish site and safe working environment',
        ]);
        //Stripping
        DB::table('scope')->insert([ //2
            'name' => 'Strip entire area of existing waterproofing and discard',
        ]);
        //Boarded
            //fillets
        DB::table('scope')->insert([ //3
            'name' => 'Install laser-cut foam moulds of the sheet trough',
        ]);
        //Sanika boards
        DB::table('scope')->insert([ //4
            'name' => 'Mechanically install the Sanika light-weight, highly-insulative boards',
        ]);
        //Wooden boards
        DB::table('scope')->insert([ //5
            'name' => 'Mechanically install 16mm marine-grade wooden OSB boards',
        ]);
        //Screed Repair
        DB::table('scope')->insert([ //6
            'name' => 'Where required, repair substrate by removing and lose areas and re-screed to correct falls to the outlets for correct drainage',
        ]);
        //Prime
        DB::table('scope')->insert([ //7
            'name' => 'Prime the entire upper surface of newly installed boards with heat activated primer',
        ]);
        //Torch-on
            //Mineral
        DB::table('scope')->insert([ //8
            'name' => 'Install mineral surface, maintenace-free, heat bonded, industrial grade torch-on waterproofing membrane',
        ]);
        //Plain
        DB::table('scope')->insert([ //9
            'name' => 'Install plain, heat bonded, industrial grade torch-on waterproofing membrane',
        ]);
        //Acrylic Flashing
        DB::table('scope')->insert([ //10
            'name' => 'Terminate all waterproofing including protrusions, upstands, headwalls and side-walls using non-woven, polyester membrane empregnated with 100% pure acrylis waterproofing compound',
        ]);
        DB::table('scope')->insert([ //11
            'name' => 'Clean and de-establish site',
        ]);
    }
}
