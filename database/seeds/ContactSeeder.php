<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('contacts')->insert([
            'company_id' => 1,
            'first_name' => 'Samuel',
            'last_name' => 'Jackson',
            'job_title' => 'Manager',
            'department' => '',
            'region' => 'Johannesburg',
            'country' => 'South Africa',
            'contact1' => '828344545',
            'email' => 'sam@libprop.co.za',
            'created_at' => Carbon::now(),
        ]);
        DB::table('contacts')->insert([
            'company_id' => 2,
            'first_name' => 'Trevor',
            'last_name' => 'Michaels',
            'job_title' => '',
            'department' => '',
            'region' => 'Johannesburg',
            'country' => 'South Africa',
            'contact1' => '828344545',
            'email' => 'trevor@michaels.co.za',
            'created_at' => Carbon::now(),
        ]);
        DB::table('contacts')->insert([
            'company_id' => 2,
            'first_name' => 'Granny',
            'last_name' => 'Seape',
            'job_title' => '',
            'department' => '',
            'region' => 'Johannesburg',
            'country' => 'South Africa',
            'contact1' => '715647890',
            'email' => 'granny@seape.co.za',
            'created_at' => Carbon::now(),
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
