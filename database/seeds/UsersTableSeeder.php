<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
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
            'email' => 'paul@sanika.com',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27825654026',
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Roark McColgan',
            'username' => 'roark',
            'email' => 'roark@sanika.com',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27712871097',
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Tanika McColgan',
            'username' => 'tanika',
            'email' => 'admin@sanika.com',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27837934504',
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Colte Smit',
            'username' => 'colte',
            'email' => 'colte@sanika.com',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27829285788',
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Sandor Smit',
            'username' => 'sandor',
            'email' => 'sandor@sanika.com',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27829225586',
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Lynda Smit',
            'username' => 'lynda',
            'email' => 'lynda@sanika.com',
            'password' => bcrypt('1q2w3e4R'),
            'cell' => '+27825530151',
            'created_at' => Carbon::now()
        ]);
    }
}
