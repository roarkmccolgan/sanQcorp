<?php

use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'created_at' => Carbon::now()
        ]);
    }
}
