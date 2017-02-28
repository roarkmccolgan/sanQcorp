<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([ //1
            'name' => 'Waterproofing'
        ]);
        DB::table('category')->insert([ //2
            'name' => 'Cementitious'
        ]);
        DB::table('category')->insert([ //3
            'name' => 'Sand'
        ]);
        DB::table('category')->insert([ //4
            'name' => 'Fasteners'
        ]);
        DB::table('category')->insert([ //5
            'name' => 'Coating'
        ]);
    }
}
