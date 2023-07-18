<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Paul Smit',
            'username' => 'paul',
            'email' => 'paul@sanika.co.za',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27825654026',
            'insightly_id' => 918110,
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Roark McColgan',
            'username' => 'roark',
            'email' => 'roarkmccolgan@gmail.com',
            'password' => bcrypt('sprite'),
            'cell' => '+27712871097',
            'insightly_id' => 980209,
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Tanika McColgan',
            'username' => 'tanika',
            'email' => 'admin@sanika.co.za',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27837934504',
            'insightly_id' => 918109,
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Colte Smit',
            'username' => 'colte',
            'email' => 'colte@sanika.co.za',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27829285788',
            'insightly_id' => 918110,
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Sandor Dowling',
            'username' => 'sandor',
            'email' => 'sandor@sanika.co.za',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27829225586',
            'insightly_id' => 913412,
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Lynda Smit',
            'username' => 'lynda',
            'email' => 'lynda@sanika.co.za',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27825530151',
            'insightly_id' => 918110,
            'created_at' => Carbon::now(),
        ]);
    }
}
