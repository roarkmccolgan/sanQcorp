<?php

namespace Database\Seeders;

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
        DB::table('categories')->insert([ //1
            'name' => 'Waterproofing',
        ]);
        DB::table('categories')->insert([ //2
            'name' => 'Cementitious',
        ]);
        DB::table('categories')->insert([ //3
            'name' => 'Sand',
        ]);
        DB::table('categories')->insert([ //4
            'name' => 'Fasteners',
        ]);
        DB::table('categories')->insert([ //5
            'name' => 'Coating',
        ]);
        DB::table('categories')->insert([ //6
            'name' => 'Fuel',
        ]);

        DB::table('categories')->insert([ //7
            'name' => 'Kryton',
        ]);
    }
}
