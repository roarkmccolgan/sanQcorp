<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LabourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labours')->insert([ //1
            'type' => 'labourer',
            'day_rate' => 180,
            'created_at' => Carbon::now()
        ]);
        DB::table('labours')->insert([ //2
            'type' => 'Tourcher',
            'day_rate' => 250,
            'created_at' => Carbon::now()
        ]);
        DB::table('labours')->insert([ //3
            'type' => 'Builder',
            'day_rate' => 250,
            'created_at' => Carbon::now()
        ]);
        DB::table('labours')->insert([ //4
            'type' => 'Driver',
            'day_rate' => 250,
            'created_at' => Carbon::now()
        ]);
        DB::table('labours')->insert([ //5
            'type' => 'Supervisor',
            'day_rate' => 500,
            'created_at' => Carbon::now()
        ]);
    }
}
