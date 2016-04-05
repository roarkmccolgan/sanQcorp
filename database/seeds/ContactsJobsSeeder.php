<?php

use Illuminate\Database\Seeder;

class ContactsJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_job')->insert([
            'contact_id' => 1,
            'job_id' => 1
        ]);
    }
}
