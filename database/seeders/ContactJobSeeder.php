<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('contact_job')->insert([
            'contact_id' => 1,
            'job_id' => 7029,
        ]);
        DB::table('contact_job')->insert([
            'contact_id' => 1,
            'job_id' => 7030,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
