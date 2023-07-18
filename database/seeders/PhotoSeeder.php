<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'photo' => 'boarded_concrete.jpg',
            'photoable_id' => 9,
            'photoable_type' => 'App\system',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('photos')->insert([
            'photo' => 'boarded_ibr.jpg',
            'photoable_id' => 10,
            'photoable_type' => 'App\system',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('photos')->insert([
            'photo' => 'boarded_poly.jpg',
            'photoable_id' => 13,
            'photoable_type' => 'App\system',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
