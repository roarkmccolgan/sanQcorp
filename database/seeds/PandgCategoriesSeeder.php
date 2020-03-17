<?php

use Illuminate\Database\Seeder;

class PandgCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pandg_categories')->insert([ //1
            'name' => 'Access',
        ]);
        DB::table('pandg_categories')->insert([ //2
            'name' => 'Medicals',
        ]);
        DB::table('pandg_categories')->insert([ //3
            'name' => 'Induction',
        ]);
        DB::table('pandg_categories')->insert([ //4
            'name' => 'Accomodation',
        ]);
        DB::table('pandg_categories')->insert([ //5
            'name' => 'Overtime',
        ]);
        DB::table('pandg_categories')->insert([ //6
            'name' => 'Sub-Contractor',
        ]);
    }
}
