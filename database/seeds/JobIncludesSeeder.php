<?php

use Illuminate\Database\Seeder;

class JobIncludesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('job_includes')->insert([
    		'item' => 'All Materials required to complete the full scope of work described above.',
    		'type' => 'includes',
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'All labour (skilled).',
    		'type' => 'includes',
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'Onsite Trained Supervisors.',
    		'type' => 'includes',
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'Supervisory inspections by Kryton’s Authorised Agents “Sanika”',
    		'type' => 'includes',
                        'default' => 0
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'All tools, machinery and equipment.',
    		'type' => 'includes',
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'Staff PPE and all relevant safety equipment.',
    		'type' => 'includes',
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'All documentation and record keeping as per Anglo Smelters Polokwane Requirements.',
    		'type' => 'includes',
                        'default' => 0
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'Curing Tarpaulins.',
    		'type' => 'includes',
                        'default' => 0
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'Shade Cloth backing to the vertical scaffold for personnel protection',
    		'type' => 'includes',
                        'default' => 0
         ]);
    	DB::table('job_includes')->insert([
    		'item' => 'Safety Files',
    		'type' => 'includes',
         ]);
        //excludes
        DB::table('job_includes')->insert([
            'item' => 'Rubble removal',
            'type' => 'excludes'
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Painting',
            'type' => 'excludes',
            'default' => 0
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Replacing of gutters',
            'type' => 'excludes'
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Removal of solar panels, satellite dishes, aircon units, JoJo\'s etc',
            'type' => 'excludes'
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Re-installation of solar panels; satellite dishes, aircon units etc',
            'type' => 'excludes'
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Scaffolding, access platforms and life lines',
            'type' => 'excludes'
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Air - 6 BAR 300CFM Compressor',
            'type' => 'excludes',
            'default' => 0
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Slag for sandblasting.',
            'type' => 'excludes',
            'default' => 0
            ]);
        DB::table('job_includes')->insert([
            'item' => '220V 32A Electrical supply.',
            'type' => 'excludes',
            'default' => 0
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Water Supply',
            'type' => 'excludes',
            'default' => 0
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Living out',
            'type' => 'excludes'
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Medicals',
            'type' => 'excludes'
            ]);
        DB::table('job_includes')->insert([
            'item' => 'Site Container',
            'type' => 'excludes'
            ]);
    }
}
