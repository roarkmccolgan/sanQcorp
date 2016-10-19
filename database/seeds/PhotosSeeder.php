<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PhotosSeeder extends Seeder
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
            'meta' => '{}',
            'photoable_id' => 1,
            'photoable_type' => 'App\system',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('photos')->insert([
            'photo' => 'boarded_ibr.jpg',
            'meta' => '{}',
            'photoable_id' => 2,
            'photoable_type' => 'App\system',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('photos')->insert([
            'photo' => 'boarded_poly.jpg',
            'meta' => '{}',
            'photoable_id' => 3,
            'photoable_type' => 'App\system',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
