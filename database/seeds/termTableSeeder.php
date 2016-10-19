<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class termTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terms')->insert([ //1
            'term' => 'All above prices Exclude VAT and are valid for 30 days.',
            'default' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //2
            'term' => 'Any errors and/or omissions are excluded.',
            'default' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //3
            'term' => 'Any guarantees offered will only come into effect once the contract is complete and the contract amount has been paid in full.',
            'default' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //4
            'term' => 'Whilst the utmost care and stringent safety procedures are followed, Sanika cannot be held liable for any damages or breakages of the surrounding areas (including tiles) and or injuries to persons whilst working on the roof.',
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //5
            'term' => 'Pricing outlined above excludes tiling and tiles. Tiles to be purchased by client and installed by others.',
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //6
            'term' => 'A 60% deposit is required on order with balance payable on completion of the job.',
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //7
            'term' => 'Pricing above is outlined for all sections to be done concurrently.',
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //8
            'term' => 'Client is responsible for the integrity of the underlying substrate for adhesion of waterproofing materials.',
            'created_at' => Carbon::now()
        ]);


    }
}
