<?php

use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surveys')->insert([ //1
            'survey' => 'After conducting an intensive survey of the aforementioned site, we discovered a number various water penetration points.'
        ]);
        DB::table('surveys')->insert([ //1
            'survey' => 'We have based the below quoation on the issues you discussed with yourselves telephonically'
        ]);
    }
}
