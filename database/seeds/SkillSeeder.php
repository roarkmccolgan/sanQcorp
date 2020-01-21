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
        DB::table('skills')->insert([ //1
            'name' => 'Labourer',
            'rate' => 18000
        ]);

        DB::table('skills')->insert([ //2
            'name' => 'Torcher',
            'rate' => 30000
        ]);

        DB::table('skills')->insert([ //3
            'name' => 'Driver',
            'rate' => 24500
        ]);

        DB::table('skills')->insert([ //4
            'name' => 'Waterproofer',
            'rate' => 18000
        ]);

        DB::table('skills')->insert([ //5
            'name' => 'Supervisor',
            'rate' => 68100
        ]);

        DB::table('skills')->insert([ //6
            'name' => 'Builder',
            'rate' => 22000
        ]);

        DB::table('skills')->insert([ //7
            'name' => 'Painter',
            'rate' => 15000
        ]);
    }
}
