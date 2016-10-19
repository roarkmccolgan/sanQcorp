<?php

use Illuminate\Database\Seeder;

class PandGCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pandg_category')->insert([ //1
            'name' => 'Access'
        ]);
        DB::table('pandg_category')->insert([ //2
            'name' => 'Medicals'
        ]);
        DB::table('pandg_category')->insert([ //3
            'name' => 'Induction'
        ]);
        DB::table('pandg_category')->insert([ //4
            'name' => 'Accomodation'
        ]);
        DB::table('pandg_category')->insert([ //5
            'name' => 'Overtime'
        ]);
        DB::table('pandg_category')->insert([ //6
            'name' => 'Sub-Contractor'
        ]);
    }
}
