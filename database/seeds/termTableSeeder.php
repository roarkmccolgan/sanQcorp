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
            'term' => 'Above pricing includes scaffolding, access equipment, safety files, site management and all necessary safety equipment and PPE.',
            'created_at' => Carbon::now(),
            'editable' => 1
        ]);

        DB::table('terms')->insert([ //4
            'term' => 'Any guarantees offered will only come into effect once the contract is complete and the contract amount has been paid in full.',
            'default' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //5
            'term' => 'Excludes replacing of any gutters.',
            'created_at' => Carbon::now(),
            'editable' => 1
        ]);

        DB::table('terms')->insert([ //6
            'term' => 'A 60% deposit is required with balance payable on completion (within 7 days).',
            'default' => 1,
            'created_at' => Carbon::now(),
            'editable' => 1
        ]);

        DB::table('terms')->insert([ //7
            'term' => 'All items remain the property of Sanika until paid for in full.',
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //8
            'term' => 'Whilst the utmost care and stringent safety procedures are followed, Sanika cannot be held liable for any damages or breakages of the immediate and surrounding areas (including ancillary items and vehicles not removed from the surrounding areas while work is being conducted) and or injuries to persons whilst working on the site.',
            'default' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //9
            'term' => 'Client is responsible for the integrity of the underlying structure for the adhesion of waterproofing materials.',
            'default' => 1,
            'created_at' => Carbon::now()
        ]);
        
        DB::table('terms')->insert([ //10
            'term' => 'Client to supply items not included in proposal as outlined above.',
            'default' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //11
            'term' => 'Pricing based on sizing measured on site and excludes any interior works',
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //12
            'term' => 'Pricing is for all items listed above to be ordered and completed concurrently for the success of the job',
            'created_at' => Carbon::now()
        ]);

        DB::table('terms')->insert([ //13
            'term' => 'Please note that Application step 1 and step 2 must done concurrently for the success of the job',
            'created_at' => Carbon::now(),
            'editable' => 1
        ]);

        DB::table('terms')->insert([ //14
            'term' => 'The above proposal is to repair concrete damage / degradation that is visible. Should additional issues be evident once works have commenced these will be communicated with client and quoted for accordingly.',
            'created_at' => Carbon::now(),
            'editable' => 1
        ]);

        DB::table('terms')->insert([ //15
            'term' => 'Sanika is not liable and responsible in any way for contents of any structures prior to, during and after waterproofing application.',
            'created_at' => Carbon::now()
        ]);

    }
}
