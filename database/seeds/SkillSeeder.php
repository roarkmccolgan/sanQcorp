<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill')->insert([ //1
            'name' => 'Labourer',
            'rate' => 180.00
        ]);

        DB::table('skill')->insert([ //2
            'name' => 'Torcher',
            'rate' => 300.00
        ]);

        DB::table('skill')->insert([ //3
            'name' => 'Driver',
            'rate' => 245.00
        ]);

        DB::table('skill')->insert([ //4
            'name' => 'Waterproofer',
            'rate' => 180.00
        ]);

        DB::table('skill')->insert([ //5
            'name' => 'Supervisor',
            'rate' => 681.00
        ]);

        DB::table('skill')->insert([ //6
            'name' => 'Builder',
            'rate' => 220.00
        ]);

        DB::table('skill')->insert([ //7
            'name' => 'Painter',
            'rate' => 150.00
        ]);
    }
}
